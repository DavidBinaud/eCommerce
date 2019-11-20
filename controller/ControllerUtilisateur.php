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
			var_dump($_GET);
			if (!is_null(myGet('login')) && !is_null(myGet('mdp')) && !is_null(myGet('confirmmdp')) && !is_null(myGet('email')) && !is_null(myGet('nom')) && !is_null(myGet('prenom')) && !is_null(myGet('ville')) && !is_null(myGet('pays')) && !is_null(myGet('adresse')) && !is_null(myGet('dateDeNaissance'))){
				if ($_GET['mdp'] == $_GET['confirmmdp']) {
					var_dump(filter_var (myGet('email'),FILTER_VALIDATE_EMAIL));
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
							"nonce" => $nonce
						);

						//on crée l'utilisateur objet en php
						$u = new ModelUtilisateur($data);
						
						if(ModelUtilisateur::save($u) == false){
							$view='error'; $pagetitle='Erreur de Création'; $errorType = 'Created Utilisateur: login fourni déjà existant';
						}else{
							// On prépare le mail a envoyer pour que l'utilisateur valide son adresse mail
							$login = rawurlencode($_GET['login']);
							$mail = "<a href=http://webinfo.iutmontp.univ-montp2.fr/~binaudd/eCommerce/index.php?controller=utilisateur&action=validate&login=$login&nonce=$nonce>cliquer sur le lien pour valider l'adresse email</a>";
							var_dump($mail);
							mail($_GET['email'],"Le sujet",$mail);

							$tab_u = ModelUtilisateur::selectAll();
							$view='created'; $pagetitle='Création Reussie';
						}
					}
					else{
						$view='error'; $pagetitle='ErreurUtilisateur'; $errorType = "Create d'un Utilisateur: mdp !=";
					}
				}else{
					$view='error'; $pagetitle='ErreurUtilisateur'; $errorType = "Create d'un Utilisateur: Problème d'email";
				}
			}else{
				$view='error'; $pagetitle='ErreurUtilisateur'; $errorType = "Create d'un Utilisateur: Problème de paramètres";
			}
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
    				$uemail = htmlspecialchars($u->get("email"));
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
				var_dump(Security::chiffrer(myGet('mdp')));
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
			session_unset();
			session_destroy();
			setcookie(session_name(),'',-1);
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
	


	}



?>