<?php

	require_once (File::build_path(array("model","ModelUtilisateur.php")));
	require_once (File::build_path(array("lib","Security.php")));
	require_once (File::build_path(array("lib","Session.php")));

	class ControllerUtilisateur{
		protected static $object = 'utilisateur';

		public static function error(){
			$view='error'; $pagetitle='ErreurUtilisateur'; $errorType = "Erreur Générale";
			require (File::build_path(array("view","view.php")));
		}



		public static function readAll(){
			$tab_u = ModelUtilisateur::selectAll(); 

			$view='list'; $pagetitle='Liste des Utilisateurs';
			require (File::build_path(array("view","view.php")));
		}



		public static function read(){
			if(!is_null(myGet('login'))){
				$u = ModelUtilisateur::select(myGet('login'));
				if($u == false){
					$view='error'; $pagetitle='ErreurUtilisateur'; $errorType = "Read d'un Utilisateur: login fourni non existant";
				}else
				{
					$view='detail'; $pagetitle='Detail Utilisateur';
				}
			}else{
				$view='error'; $pagetitle='ErreurUtilisateur'; $errorType = "Read d'un Utilisateur: Pas d'login fourni";	
			}
			require (File::build_path(array("view","view.php")));
		}



		public static function delete(){
			if(!is_null(myGet('login'))){
				$u = ModelUtilisateur::select(myGet('login'));
				if($u == false){
					$view='error'; $pagetitle='ErreurProduit'; $errorType = "Delete d'un Utilisateur: login fourni non existant";
				}else{
					ModelUtilisateur::delete(myGet('login'));
					$tab_u = ModelUtilisateur::selectAll();

					$view='delete'; $pagetitle='Suppresion Utilisateurs';
				}
			}else{
				$view='error'; $pagetitle='ErreurUtilisateurs'; $errorType = "Delete d'un Utilisateurs: Pas d'login fourni";
			}
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
							$view='error'; $pagetitle='Erreur de Création'; $errorType = 'Created Utilisateur: login fourni déjà existant';
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
						$view='error'; $pagetitle='ErreurUtilisateur'; $errorType = "Create d'un Utilisateur: Problème d'email";
						$redirect ='update';
					}
				}else{
					$view='error'; $pagetitle='ErreurUtilisateur'; $errorType = "Create d'un Utilisateur: Confirmation du mot de passse invalide";
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
				$view='error'; $pagetitle='ErreurUtilisateur'; $errorType = "Create d'un Utilisateur: Problème de paramètres";
			}

    		$uAction = "create";
			require (File::build_path(array("view","view.php")));
		}



		public static function update(){
			if (!is_null(myGet('login'))){
				$u = ModelUtilisateur::select(myGet('login'));

				if($u == false){
					$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'update Utilisateur: login fourni non existant';
					
				}
				else{
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
				}
			}
			else{
				$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'update Utilisateur: Problème de paramètres';
			}
			require (File::build_path(array("view","view.php")));
		}



		public static function updated(){
			if (!is_null(myGet('login')) && !is_null(myGet('mdp')) && !is_null(myGet('nom')) && !is_null(myGet('prenom')) && !is_null(myGet('ville')) && !is_null(myGet('pays')) && !is_null(myGet('adresse')) && !is_null(myGet('dateDeNaissance'))){
				
				$u = ModelUtilisateur::select(myGet('login'));
				if($u == false){
					$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'update Utilisateur: login fourni non existant';
					
				}
				else{
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

					if (ModelUtilisateur::update($data)) {
						$tab_u = ModelUtilisateur::selectAll();
						$view='updated'; $pagetitle='Mise A Jour';
					}else{
						$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'updated Utilisateur: Problème de maj rencontré';
					}
				}
			}
			else{
				$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'updated Utilisateur: Problème de paramètres';
			}
			require (File::build_path(array("view","view.php")));
			
		}



		public static function connect(){
			$view='connect'; $pagetitle='Connexion';
			require (File::build_path(array("view","view.php")));
		}


		public static function connected(){
			if(!is_null(myGet('login')) && !is_null(myGet('mdp'))){
				if(ModelUtilisateur::checkPassword(myGet('login'),Security::chiffrer(myGet('mdp')))){
					$u = ModelUtilisateur::select(myGet('login'));
					if ($u->get('nonce') == NULL) {
						$_SESSION['admin'] = $u->get('is_admin');
						$_SESSION['login'] = myGet('login');

						$view='detail'; $pagetitle='Accueil';
					}else{
						$view='error'; $pagetitle='Erreur Connexion'; $errorType = 'Erreur connected: adresse email non validée';
					}
				}else{
					$view='error'; $pagetitle='Erreur Connexion'; $errorType = 'Erreur connected: Login et Mot de passe incorrect';
				}
			}else{
				$view='error'; $pagetitle='Erreur Connexion'; $errorType = 'Erreur connected: Login et/ou Mot de passe non renseigné';
			}
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
			if (!is_null(myGet('login')) && !is_null(myGet('nonce'))) {
				$u = ModelUtilisateur::select(myGet('login'));
				if ($u != false) {
					if ($u->get('nonce') == myGet('nonce')) {
						$data = $u->get_object_vars();
						var_dump($data);
						$data['nonce'] = NULL;
						var_dump($data);
						ModelUtilisateur::update($data);
						$view='validate'; $pagetitle='Validation Email';
					}else{
						$view='error'; $pagetitle='Erreur Connexion'; $errorType = 'Erreur validate: nonce non valide';
					}
				}else{
					$view='error'; $pagetitle='Erreur Connexion'; $errorType = 'Erreur validate: Login inexistant';
				}
			}else{
				$view='error'; $pagetitle='Erreur Connexion'; $errorType = 'Erreur validate: Probleme de paramètres';
			}
			require (File::build_path(array("view","view.php")));
		}



		public static function askresetpass(){
			if (is_null(myGet('login')) && !Session::is_user(myGet('login'))) {
				$login = "";
				$view='askresetpass'; $pagetitle='Reset Password';
			}else{
				$view='error'; $pagetitle='Erreur Connexion'; $errorType = 'Vous êtes connectés, impossible de reset le mot de passe';
			}
			
			require (File::build_path(array("view","view.php")));
		}
	


		public static function sendresetpass(){
			if (!is_null(myGet('login'))) {
				$u = ModelUtilisateur::select(myGet('login'));
				if($u != false){
					$resetpass = Security::generateRandomHex();
					$login = rawurlencode(myGet('login'));

					$data = array(
						'login' => $login,
						'resetpass' => $resetpass,
					);

					if (ModelUtilisateur::update($data)) {
						$mail = "<a href=http://webinfo.iutmontp.univ-montp2.fr/~binaudd/eCommerce/index.php?controller=utilisateur&action=inputnewpass&login=$login&resetpass=$resetpass>cliquer sur le lien pour modifier votre mot de passe</a>";
						mail($u->get('email'),"Restoration du MDP",$mail);
						var_dump($mail);
						$view='resetsent'; $pagetitle='Sent Reset Password';
					}else{
						$view='error'; $pagetitle='Erreur Connexion'; $errorType = 'Erreur sendresetpass: Probleme durant l envoi du mail de restoration, veuillez réessayer ultérieurement';
					}
				}else{
					$login = myGet('login');
					$view='askresetpass'; $pagetitle='Reset Password';
				}
				
			}else{
				$view='error'; $pagetitle='Erreur Connexion'; $errorType = 'Erreur sendresetpass: probleme de paramètres';
			}
			
			require (File::build_path(array("view","view.php")));
		}



		public static function inputnewpass(){
			if(!is_null(myGet('resetpass')) && !is_null(myGet('login'))){
				$resetpass = myGet('resetpass');
				$login = myGet('login');
				$view='resetpass'; $pagetitle='Reset Password';
			}else{
				$view='error'; $pagetitle='Erreur inputnewpass'; $errorType = 'Erreur inputnewpass: probleme de paramètres';
			}
			require (File::build_path(array("view","view.php")));
		}


		public static function resetpass(){
			if(!is_null(myGet('resetpass')) && !is_null(myGet('login')) && !is_null(myGet('mdp')) && !is_null(myGet('confirmmdp'))){
				if (myGet('mdp') == myGet('confirmmdp')){
					$u = ModelUtilisateur::select(myGet('login'));
					if($u != false){
						if($u->get('resetpass') == myGet('resetpass')){
							$data = array(
								'login' => myGet('login'), 
								'mdp' => Security::chiffrer(myGet('mdp')), 
								'resetpass' => myGet('resetpass'), 
							);
							ModelUtilisateur::update($data);
							$view='resetpassconfirm'; $pagetitle='Reset Password';
						}else{
							$view='error'; $pagetitle='Erreur ResetPass'; $errorType = 'Erreur resetpass: la clé de restoration du mdp est invalide';
						}

					}else{
						$view='error'; $pagetitle='Erreur ResetPass'; $errorType = "Erreur resetpass: le Login fourni n'existe pas";
					}


				}else{
					$view='error'; $pagetitle='Erreur ResetPass'; $errorType = 'Erreur resetpass: les deux mdp sont différents';
				}
			}else{
				$view='error'; $pagetitle='Erreur ResetPass'; $errorType = 'Erreur resetpass: probleme de paramètres';
			}
			require (File::build_path(array("view","view.php")));
		}

	

	}



?>