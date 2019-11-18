<?php

	require_once (File::build_path(array("model","ModelUtilisateur.php")));

	class ControllerClient{
		protected static $object = 'utilisateur';

		public static function error(){
			$view='error'; $pagetitle='ErreurClient'; $errorType = "Erreur Générale";
			require (File::build_path(array("view","view.php")));
		}



		public static function readAll(){
			$tab_c = ModelUtilisateur::selectAll(); 

			$view='list'; $pagetitle='Liste des Utilisateurs';
			require (File::build_path(array("view","view.php")));
		}



		public static function read(){
			if(isset($_GET['id'])){
				$c = ModelUtilisateur::select($_GET['id']);
				if($c == false){
					$view='error'; $pagetitle='ErreurClient'; $errorType = "Read d'un Client: id fourni non existant";
				}else
				{
					$view='detail'; $pagetitle='Detail Client';
				}
			}else{
				$view='error'; $pagetitle='ErreurClient'; $errorType = "Read d'un Client: Pas d'id fourni";	
			}
			require (File::build_path(array("view","view.php")));
		}



		public static function delete(){
			if(isset($_GET['id'])){
				$c = ModelUtilisateur::select($_GET['id']);
				if($c == false){
					$view='error'; $pagetitle='ErreurProduit'; $errorType = "Delete d'un Client: id fourni non existant";
				}else{
					ModelUtilisateur::delete($_GET['id']);
					$tab_c = ModelUtilisateur::selectAll();

					$view='delete'; $pagetitle='Suppresion Clients';
				}
			}else{
				$view='error'; $pagetitle='ErreurClients'; $errorType = "Delete d'un Clients: Pas d'id fourni";
			}
			require (File::build_path(array("view","view.php")));
		}



		public static function create(){
    		$cId = "\"\"";
    		$cNom = "\"\"";
    		$cPrenom = "\"\"";
    		$cVille = "\"\"";
    		$cPays = "\"\"";
    		$cAdresse = "\"\"";
    		$cDateDeNaissance = "\"\"";
    		$cAction = "create";
		
			$view='update'; $pagetitle='Creation Client';
			require (File::build_path(array("view","view.php")));
		}




		public static function created(){
			if (isset($_GET['id']) && isset($_GET['nom']) && isset($_GET['prenom']) && isset($_GET['ville']) && isset($_GET['pays']) && isset($_GET['adresse']) && isset($_GET['dateDeNaissance'])){

				$c = new ModelUtilisateur($_GET);
				if(ModelUtilisateur::save($c) == false){
					$view='error'; $pagetitle='Erreur de Création'; $errorType = 'Created Client: id fourni déjà existant';
				}else{
					$tab_c = ModelUtilisateur::selectAll();
					$view='created'; $pagetitle='Création Reussie';
				}
			}else{
				$view='error'; $pagetitle='ErreurClient'; $errorType = "Create d'un Client: Problème de paramètres";
			}
			require (File::build_path(array("view","view.php")));
		}



		public static function update(){
			if (isset($_GET['id'])){
				$c = ModelUtilisateur::select($_GET['id']);

				if($c == false){
					$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'update Client: id fourni non existant';
					
				}
				else{
    				$cId = htmlspecialchars($c->get("id"));
					$cNom = htmlspecialchars($c->get("nom"));
					$cPrenom = htmlspecialchars($c->get("prenom"));
					$cVille = htmlspecialchars($c->get("ville"));
					$cPays = htmlspecialchars($c->get("pays"));
					$cAdresse = htmlspecialchars($c->get("adresse"));
					$cDateDeNaissance = htmlspecialchars($c->get("dateDeNaissance"));
    				$cAction = "update";

					$view='update'; $pagetitle='Mise A Jour';
				}
			}
			else{
				$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'update Client: Problème de paramètres';
			}
			require (File::build_path(array("view","view.php")));
		}



		public static function updated(){
			if (isset($_GET['id']) && isset($_GET['nom']) && isset($_GET['prenom']) && isset($_GET['ville']) && isset($_GET['pays']) && isset($_GET['adresse']) && isset($_GET['dateDeNaissance'])){
				
				$c = ModelUtilisateur::select($_GET['id']);
				if($c == false){
					$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'update Client: id fourni non existant';
					
				}
				else{
					$data = array(
						"id" => $_GET['id'],
						"nom" => $_GET['nom'],
						"prenom" => $_GET['prenom'],
						"ville" => $_GET['ville'],
						"pays" => $_GET['pays'],
						"adresse" => $_GET['adresse'],
						"dateDeNaissance" => $_GET['dateDeNaissance']
					);
					if (ModelUtilisateur::update($data)) {
						$tab_c = ModelUtilisateur::selectAll();
						$view='updated'; $pagetitle='Mise A Jour';
					}else{
						$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'updated Client: Problème de maj rencontré';
					}
				}
			}
			else{
				$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'updated Client: Problème de paramètres';
			}
			require (File::build_path(array("view","view.php")));
			
		}
	


	}



?>