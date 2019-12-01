<?php

	require_once (File::build_path(array("model","ModelUtilisateur.php")));
	require_once (File::build_path(array("lib","Security.php")));
	require_once (File::build_path(array("lib","Session.php")));

	class ControllerUtilisateur{
		protected static $object = 'utilisateur';

		public static function error($errorType = NULL,$redirect = NULL,$parametres = NULL){

			if(!is_null($parametres)){
				foreach ($parametres as $key => $value) {
					${$key} = $value;
				}
			}
			$hasRedirect = !is_null($redirect); // Used to check in error view if a redirection exists

			$view='error'; $pagetitle='tilisateur';;
			require (File::build_path(array("view","view.php")));
			die();
		}



		public static function readAll(){
			$tab_u = ModelUtilisateur::selectAll(); 

			$view='list'; $pagetitle='Liste des Utilisateurs';
			require (File::build_path(array("view","view.php")));
		}



		public static function read(){
			if(is_null(myGet('login')))self::error("Read d'un Utilisateur: Pas de login fourni");

			if(!Session::is_user(myGet('login')) && !Session::is_admin())self::error("Read d'un Utilisateur: Acces Restreint");

			$u = ModelUtilisateur::select(myGet('login'));
			if($u == false)self::error("Read d'un Utilisateur: login fourni non existant");
				
			$view='detail'; $pagetitle='Detail Utilisateur';
			require (File::build_path(array("view","view.php")));
		}



		public static function delete(){
			if(is_null(myGet('login')))self::error("Delete d'un Utilisateur: Pas de login fourni");

			if(!Session::is_user(myGet('login')) && !Session::is_admin())self::error("Delete d'un Utilisateur: Acces Restreint");

			$u = ModelUtilisateur::select(myGet('login'));
			if($u == false)self::error("Delete d'un Utilisateur: login fourni non existant");
			
			ModelUtilisateur::delete(myGet('login'));
			$tab_u = ModelUtilisateur::selectAll();

			$view='delete'; $pagetitle='Suppresion Utilisateurs';
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
    		$uAction = "create";
		
			$view='update'; $pagetitle='Creation Utilisateur';
			require (File::build_path(array("view","view.php")));
		}




		public static function created(){
			if (!is_null(myGet('login')) && !is_null(myGet('mdp')) && !is_null(myGet('confirmmdp')) && !is_null(myGet('email')) && !is_null(myGet('nom')) && !is_null(myGet('prenom')) && !is_null(myGet('ville')) && !is_null(myGet('pays')) && !is_null(myGet('adresse')) && !is_null(myGet('dateDeNaissance'))){
				if ($_GET['mdp'] == $_GET['confirmmdp']) {
					
					if (filter_var (myGet('email'),FILTER_VALIDATE_EMAIL)) {
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
						
						if(ModelUtilisateur::save($u) == false){
							$view='error'; $pagetitle='de Création'; $errorType = 'Created Utilisateur: login fourni déjà existant';
							$redirect ='update';
						}else{
							// On prépare le mail a envoyer pour que l'utilisateur valide son adresse mail
							$login = rawurlencode(myGet('login'));
							$mail = "<a href=http://webinfo.iutmontp.univ-montp2.fr/~binaudd/eCommerce/index.php?controller=utilisateur&action=validate&login=$login&nonce=$nonce>cliquer sur le lien pour valider l'adresse email</a>";
							mail($_GET['email'],"Le sujet",$mail);

							$tab_u = ModelUtilisateur::selectAll();
							$view='created'; $pagetitle='Création Reussie';
						}
					
					}else{
						$view='error'; $pagetitle='tilisateur'; $errorType = "Create d'un Utilisateur: Problème d'email";
						$redirect ='update';
					}
				}else{
					$view='error'; $pagetitle='tilisateur'; $errorType = "Create d'un Utilisateur: Confirmation du mot de passse invalide";
					$redirect ='update';
				}
				$ulogin = htmlspecialchars(myGet('login'));
				$uEmail = htmlspecialchars(myGet('email'));
	    		$uNom = htmlspecialchars(myGet('nom'));
	    		$uPrenom = htmlspecialchars(myGet('prenom'));
	    		$uVille = htmlspecialchars(myGet('ville'));
	    		$uPays = htmlspecialchars(myGet('pays'));
	    		$uAdresse = htmlspecialchars(myGet('adresse'));
	    		$uDateDeNaissance = htmlspecialchars(myGet('dateDeNaissance'));
			}else{
				$view='error'; $pagetitle='tilisateur'; $errorType = "Create d'un Utilisateur: Problème de paramètres";
			}

    		$uAction = "create";
			require (File::build_path(array("view","view.php")));
		}



		public static function update(){
			if (is_null(myGet('login')))self::error('update Utilisateur: Problème de paramètres');

			if(!Session::is_user(myGet('login')) && !Session::is_admin())self::error("Update d'un Utilisateur: Acces Restreint");

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
			$uAction = "update";

			$view='update'; $pagetitle='Mise A Jour';
			require (File::build_path(array("view","view.php")));
		}



		public static function updated(){


			if (is_null(myGet('login')) && is_null(myGet('mdp')) && is_null(myGet('nom')) && is_null(myGet('prenom')) && is_null(myGet('ville')) && is_null(myGet('pays')) && is_null(myGet('adresse')) && is_null(myGet('dateDeNaissance')))self::error('updated Utilisateur: Problème de paramètres');
			
			if(!Session::is_user(myGet('login')) && !Session::is_admin())self::error("Updated d'un Utilisateur: Acces Restreint");

			$u = ModelUtilisateur::select(myGet('login'));
			if($u == false) self::error('update Utilisateur: login fourni non existant');


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

			if (!ModelUtilisateur::update($data)) self::error('updated Utilisateur: Problème de maj rencontré');
			$tab_u = ModelUtilisateur::selectAll();

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

			$view='detail'; $pagetitle='Accueil';
			require (File::build_path(array("view","view.php")));
		}


		public static function deconnect(){
			//Pour tout destroy de la session
			//session_unset();
			//session_destroy();
			//setcookie(session_name(),'',-1);


			//On unset seulement ce qui existe lors de la connexion pour garder le panier après déconnexion
			unset($_SESSION['login']);
			unset($_SESSION['admin']);

			$pagetitle='Deconnection';
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