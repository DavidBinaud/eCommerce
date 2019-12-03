<?php

	require_once (File::build_path(array("model","ModelUtilisateur.php")));
	require_once (File::build_path(array("lib","Security.php")));
	require_once (File::build_path(array("lib","Session.php")));

	class ControllerUtilisateur{
		protected static $object = 'utilisateur';

		// $parametres doit être un array
		// function error([string $errorType[,string $redirect[,array $parametres]]])..
		public static function error($errorType = NULL,$redirect = NULL,$parametres = NULL){

			//pour chaque element dans $parametre on va créer une variable nommé avec le nom de la clé et contenant comme valeur la valeur associée à cette clé
			if(!is_null($parametres) && is_array($parametres)){
				foreach ($parametres as $key => $value) {
					${$key} = $value;
				}
			}
			$hasRedirect = !is_null($redirect); // Used to check in error view if a redirection exists

			$view='error'; $pagetitle='Utilisateur';;
			require (File::build_path(array("view","view.php")));
			die();
		}



		public static function readAll(){
			if(!Session::is_admin())self::error("ReadAll Utilisateur: Acces Restreint<i class='material-icons left'>lock</i>");
			$tab_u = ModelUtilisateur::selectAll(); 

			$view='list'; $pagetitle='Liste des Utilisateurs';
			require (File::build_path(array("view","view.php")));
		}



		public static function read(){

			if(is_null(myGet('login')))self::error("Read d'un Utilisateur: Pas de login fourni");


			if(!Session::is_user(myGet('login')) && !Session::is_admin())self::error("Read d'un Utilisateur: Acces Restreint<i class='material-icons left'>lock</i>");

			$u = ModelUtilisateur::select(myGet('login'));
			if($u == false)self::error("Read d'un Utilisateur: login fourni non existant");
				
			$ulogin = htmlspecialchars($u->get("login"));
			$uloginURL = rawurlencode($u->get("login"));
			$uemail = htmlspecialchars($u->get("email"));
			$unom = htmlspecialchars($u->get("nom"));
			$uprenom = htmlspecialchars($u->get("prenom"));
			$uville = htmlspecialchars($u->get("ville"));
			$upays = htmlspecialchars($u->get("pays"));
			$uadresse = htmlspecialchars($u->get("adresse"));
			$udateDeNaissance = htmlspecialchars($u->get("dateDeNaissance"));

			$view='detail'; $pagetitle='Detail Utilisateur';
			require (File::build_path(array("view","view.php")));
		}



		public static function delete(){
			if(is_null(myGet('login')))self::error("Delete d'un Utilisateur: Pas de login fourni");

			if(!Session::is_user(myGet('login')) && !Session::is_admin())self::error("Delete d'un Utilisateur: Acces Restreint<i class='material-icons left'>lock</i>");

			$u = ModelUtilisateur::select(myGet('login'));
			if($u == false)self::error("Delete d'un Utilisateur: login fourni non existant");
			
			ModelUtilisateur::delete(myGet('login'));
			$cid = htmlspecialchars(myGet('login'));
			$tab_u = ModelUtilisateur::selectAll();

			if(Session::is_user(myGet('login'))){
				self::deconnect();
				die();
			}else{
				$view='delete';
			}
			$pagetitle='Suppresion Utilisateurs';
			require (File::build_path(array("view","view.php")));
		}



		public static function create(){
    		$ulogin = "\"\"";
    		$uNom = "\"\"";
    		$uEmail = "\"\"";
    		$uPrenom = "\"\"";
    		$uVille = "\"\"";
    		$uPays = "\"\"";
    		$uAdresse = "\"\"";
    		$uDateDeNaissance = "\"\"";
    		$is_create = "create";
		
			$view='update'; $pagetitle='Creation Utilisateur';
			require (File::build_path(array("view","view.php")));
		}




		public static function created(){
			$redirectParametres = array(
							"login" => htmlspecialchars(myGet('login')),
							"email" => htmlspecialchars(myGet('email')),
							"nom" => htmlspecialchars(myGet('nom')),
							"prenom" => htmlspecialchars(myGet('prenom')),
							"ville" => htmlspecialchars(myGet('ville')),
							"pays" => htmlspecialchars(myGet('pays')),
							"adresse" => htmlspecialchars(myGet('adresse')),
							"dateDeNaissance" => htmlspecialchars(myGet('dateDeNaissance')),
							"is_admin" => htmlspecialchars(myGet('is_admin')),
							"is_create" => true
						);
			if (is_null(myGet('login')) || is_null(myGet('mdp')) || is_null(myGet('confirmmdp')) || is_null(myGet('email')) || is_null(myGet('nom')) || is_null(myGet('prenom')) || is_null(myGet('ville')) || is_null(myGet('pays')) || is_null(myGet('adresse')) || is_null(myGet('dateDeNaissance')))self::error("Create d'un Utilisateur: Problème de paramètres","update", $redirectParametres);



			if (myGet('mdp') != myGet('confirmmdp'))self::error("Create d'un Utilisateur: Confirmation du mot de passse invalide","update", $redirectParametres);
					
			if (!filter_var (myGet('email'),FILTER_VALIDATE_EMAIL))self::error("Create d'un Utilisateur: Problème d'email","update", $redirectParametres);
			
			//nonce pour la verification par mail
			$nonce = Security::generateRandomHex();

			//on verifie si on nous a passé le parametre d'admin
			if(!is_null(myGet('is_admin'))){
				$is_admin = myGet('is_admin');
			}else{
				$is_admin = 0;
			}

			$data = array(
				"login" => myGet('login'),
				"mdp" => Security::chiffrer(myGet('mdp')),
				"email" => myGet('email'),
				"nom" => myGet('nom'),
				"prenom" => myGet('prenom'),
				"ville" => myGet('ville'),
				"pays" => myGet('pays'),
				"adresse" => myGet('adresse'),
				"dateDeNaissance" => myGet('dateDeNaissance'),
				"is_admin" => $is_admin,
				"nonce" => $nonce,
				"resetpass" => NULL
			);

			//on crée l'utilisateur objet en php
			$u = new ModelUtilisateur($data);
			
			if(ModelUtilisateur::save($u) == false)self::error('Created Utilisateur: login fourni déjà existant','update',$redirectParametres);
			// On prépare le mail a envoyer pour que l'utilisateur valide son adresse mail
			$login = rawurlencode(myGet('login'));
			$mail = "<a href=http://webinfo.iutmontp.univ-montp2.fr/~binaudd/eCommerce/index.php?controller=utilisateur&action=validate&login=$login&nonce=$nonce>cliquer sur le lien pour valider l'adresse email</a>";
			mail(myGet('email'),"Le sujet",$mail);

				
				
			
					
			$login = htmlspecialchars(myGet('login'));
			$email = htmlspecialchars(myGet('email'));
    		$nom = htmlspecialchars(myGet('nom'));
    		$prenom = htmlspecialchars(myGet('prenom'));
    		$ville = htmlspecialchars(myGet('ville'));
    		$pays = htmlspecialchars(myGet('pays'));
    		$adresse = htmlspecialchars(myGet('adresse'));
    		$dateDeNaissance = htmlspecialchars(myGet('dateDeNaissance'));


    		$is_create = true;
    		$tab_u = ModelUtilisateur::selectAll();
    		$view='created'; $pagetitle='Création Reussie';
			require (File::build_path(array("view","view.php")));
		}



		public static function update(){

			if (is_null(myGet('login')))self::error('update Utilisateur: Problème de paramètres');

			if(!Session::is_user(myGet('login')) && !Session::is_admin())self::error("Update d'un Utilisateur: Acces Restreint<i class='material-icons left'>lock</i>");

			$u = ModelUtilisateur::select(myGet('login'));
			if($u == false)self::error('update Utilisateur: login fourni non existant');


			$ulogin = htmlspecialchars($u->get("login"));
			$uEmail = htmlspecialchars($u->get("email"));
			$uNom = htmlspecialchars($u->get("nom"));
			$uPrenom = htmlspecialchars($u->get("prenom"));
			$uVille = htmlspecialchars($u->get("ville"));
			$uPays = htmlspecialchars($u->get("pays"));
			$uAdresse = htmlspecialchars($u->get("adresse"));
			$uDateDeNaissance = htmlspecialchars($u->get("dateDeNaissance"));

			$is_create = false;
			$view='update'; $pagetitle='Mise A Jour';
			require (File::build_path(array("view","view.php")));
		}



		public static function updated(){
			$redirectParametres = array(
				"login" => htmlspecialchars(myGet('login')),
				"email" => htmlspecialchars(myGet('email')),
				"nom" => htmlspecialchars(myGet('nom')),
				"prenom" => htmlspecialchars(myGet('prenom')),
				"ville" => htmlspecialchars(myGet('ville')),
				"pays" => htmlspecialchars(myGet('pays')),
				"adresse" => htmlspecialchars(myGet('adresse')),
				"dateDeNaissance" => htmlspecialchars(myGet('dateDeNaissance')),
				"is_admin" => htmlspecialchars(myGet('is_admin')),
				"is_create" => false
			);

			if (is_null(myGet('login')) || is_null(myGet('mdp')) || is_null(myGet('nom')) || is_null(myGet('prenom')) || is_null(myGet('ville')) || is_null(myGet('pays')) || is_null(myGet('adresse')) || is_null(myGet('dateDeNaissance')))self::error('updated Utilisateur: Problème de paramètres'	,"update",$redirectParametres);
			
			if(!Session::is_user(myGet('login')) && !Session::is_admin())self::error("Updated d'un Utilisateur: Acces Restreint<i class='material-icons left'>lock</i>","update",$redirectParametres);

			$u = ModelUtilisateur::select(myGet('login'));
			if($u == false) self::error('update Utilisateur: login fourni non existant',"update",$redirectParametres);


			$data = array(
				"login" => myGet('login'),
				"mdp" => myGet('mdp'),
				"email" => myGet('email'),
				"nom" => myGet('nom'),
				"prenom" => myGet('prenom'),
				"ville" => myGet('ville'),
				"pays" => myGet('pays'),
				"adresse" => myGet('adresse'),
				"dateDeNaissance" => myGet('dateDeNaissance'),
			);

			if(!is_null(myGet('is_admin'))){
				$data[] = myGet('is_admin');
			}

			if (!ModelUtilisateur::update($data)) self::error('updated Utilisateur: Problème de maj rencontré',"update",$redirectParametres);

			$tab_u = ModelUtilisateur::selectAll();
			$login = htmlspecialchars(myGet('login'));

			$view='updated'; $pagetitle='Mise A Jour';
			require (File::build_path(array("view","view.php")));
			
		}



		public static function connect(){
			$login = '';
			$view='connect'; $pagetitle='Connexion';
			require (File::build_path(array("view","view.php")));
		}


		public static function connected(){
			if(is_null(myGet('login')) && is_null(myGet('mdp')))self::error('connected: Login et/ou Mot de passe non renseigné');
			
			$u = ModelUtilisateur::select(myGet('login'));
			if($u == false)self::error('connected: Login inconnu','connect',array('login' => myGet('login')));

			if(!ModelUtilisateur::checkPassword(myGet('login'),Security::chiffrer(myGet('mdp'))))self::error('connected: Mot de passe incorrect','connect',array('login' => myGet('login')));
					
			if ($u->get('nonce') != NULL) self::error('connected: adresse email non validée');
			
			$_SESSION['admin'] = $u->get('is_admin');
			$_SESSION['login'] = myGet('login');

			self::read();
		}


		public static function deconnect(){
			//Pour tout destroy de la session
			//session_unset();
			//session_destroy();
			//setcookie(session_name(),'',-1);


			//On unset seulement ce qui existe lors de la connexion pour garder le panier après déconnexion
			unset($_SESSION['login']);
			unset($_SESSION['admin']);
			header('Location: index.php');
			exit(); 
		}


		public static function validate(){
			if (is_null(myGet('login')) && is_null(myGet('nonce'))) self::error('validate: Probleme de paramètres');

			$u = ModelUtilisateur::select(myGet('login'));
			if ($u == false) self::error('validate: Login inexistant');
			
			if ($u->get('nonce') != myGet('nonce'))self::error('validate: nonce non valide');
			$u->set('nonce',NULL);
			
			if(!ModelUtilisateur::update($u->get_object_vars()))self::error('validate: erreur Serveur');

			$view='validate'; $pagetitle='Validation Email';
			require (File::build_path(array("view","view.php")));
		}



		public static function askresetpass(){
			if (isset($_SESSION['login']))self::error('Vous êtes connectés, impossible de reset le mot de passe');
			
			$login = ''; // Utilisation Future, vide ici
			$view='askresetpass'; $pagetitle='Reset Password';
			require (File::build_path(array("view","view.php")));
		}
	


		public static function sendresetpass(){
			if (is_null(myGet('login'))) self::error('sendresetpass: probleme de paramètres');
			
			$u = ModelUtilisateur::select(myGet('login'));
			//Erreur avec redirection vers le formulaire de demande de reset; parametres pour le préremplissage
			if($u == false) self::error("SendResetPass: Login incorrect","askresetpass",array("login" => myGet('login')));
			
			$resetpass = Security::generateRandomHex();
			$login = rawurlencode(myGet('login'));

			$data = array(
				'login' => $login,
				'resetpass' => $resetpass,
			);

			if (!ModelUtilisateur::update($data)) self::error('sendresetpass: Erreur Serveur');

			$mail = "<a href=http://webinfo.iutmontp.univ-montp2.fr/~binaudd/eCommerce/index.php?controller=utilisateur&action=inputnewpass&login=$login&resetpass=$resetpass>cliquer sur le lien pour modifier votre mot de passe</a>";
			var_dump($mail);

			if(!mail($u->get('email'),"Restoration du MDP",$mail))self::error("SendResetPass: Erreur lors de l'envoi du mail");

			$view='resetsent'; $pagetitle='Sent Reset Password';
			require (File::build_path(array("view","view.php")));
		}



		public static function inputnewpass(){
			if(is_null(myGet('resetpass')) && is_null(myGet('login'))) self::error('inputnewpass: probleme de paramètres');
			$resetpass = myGet('resetpass');
			$login = myGet('login');

			$view='resetpass'; $pagetitle='Reset Password';
			require (File::build_path(array("view","view.php")));
		}


		public static function resetpass(){
			if(is_null(myGet('resetpass')) && is_null(myGet('login')) && is_null(myGet('mdp')) && is_null(myGet('confirmmdp'))) self::error('resetpass: probleme de paramètres');
			
			if (myGet('mdp') != myGet('confirmmdp'))self::error('resetpass: les deux mdp sont différents',"resetpass",array('resetpass' => myGet('resetpass'), 'login' => myGet('login')));
			
			$u = ModelUtilisateur::select(myGet('login'));
			
			if($u == false) self::error("resetpass: le Login fourni n'existe pas");
			
			if($u->get('resetpass') != myGet('resetpass'))self::error("resetpass: la clé de restoration du mdp est invalide");
			
			$data = array(
				'login' => myGet('login'), 
				'mdp' => Security::chiffrer(myGet('mdp')), 
				'resetpass' => myGet('resetpass'), 
			);
			
			if(!ModelUtilisateur::update($data)) self::error("Ereur ResetPass: Erreur de communication avec le serveur");
			
			$view='resetpassconfirm'; $pagetitle='Reset Password';
			require (File::build_path(array("view","view.php")));
		}

	

	}



?>