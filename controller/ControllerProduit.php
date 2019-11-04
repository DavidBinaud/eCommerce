<?php

	require_once (File::build_path(array("model","ModelProduit.php")));

	class ControllerProduit{
		protected static $object = 'produit';

		public static function error(){
			$view='error'; $pagetitle='ErreurProduit'; $errorType = 'Erreur Générale';
			require (File::build_path(array("view","view.php")));
		}



		public static function readAll(){
			$tab_p = ModelProduit::selectAll(); 

			$view='list'; $pagetitle='Liste des Produits';
			require (File::build_path(array("view","view.php")));
		}



		public static function read(){
			if(isset($_GET['id'])){
				$p = ModelProduit::select($_GET['id']);
				if($p == false){
					
					$view='error'; $pagetitle='ErreurProduit'; $errorType = "Read d'un Produit: id fourni non existant";
					require (File::build_path(array("view","view.php")));
				}
				else{	
					$path = $p->get_img_path();
					$view='detail'; $pagetitle='Detail Produit';
					require (File::build_path(array("view","view.php")));
				}
			}else{
				$view='error'; $pagetitle='ErreurProduit'; $errorType = "Read d'un Produit: Pas d'id fourni";
				require (File::build_path(array("view","view.php")));
			}
		}



		public static function delete(){
			if(isset($_GET['id'])){
				$p = ModelProduit::select($_GET['id']);
				if($p == false){
					$view='error'; $pagetitle='ErreurProduit'; $errorType = "Delete d'un Produit: id fourni non existant";
					require (File::build_path(array("view","view.php")));
				}else{
					ModelProduit::delete($_GET['id']);
					$tab_p = ModelProduit::selectAll();

					$view='delete'; $pagetitle='Suppresion Produit';
					require (File::build_path(array("view","view.php")));
				}
			}else{
				$view='error'; $pagetitle='ErreurProduit'; $errorType = "Delete d'un Produit: Pas d'id fourni";
				require (File::build_path(array("view","view.php")));
			}
		}



		public static function create(){
    		$pId = "\"\"";
    		$pNom = "\"\"";
    		$pDescription = "\"\"";
    		$pPrix = "\"\"";
    		$pNationalite = "\"\"";
    		$pAction = "create";
		
			$view='update'; $pagetitle='Creation Produit';
			require (File::build_path(array("view","view.php")));
		}



		public static function created(){
			if (isset($_GET['id']) && isset($_GET['nom']) && isset($_GET['description']) && isset($_GET['prix']) && isset($_GET['nationalite'])){

				$p = new ModelProduit($_GET);
				var_dump($p);
				if(ModelProduit::save($p) == false){
					$view='error'; $pagetitle='Erreur de Création'; $errorType = 'Created Produit: id fourni déjà existant';
					require (File::build_path(array("view","view.php")));
				}else{
					$tab_p = ModelProduit::selectAll();
					$view='created'; $pagetitle='Création Reussie';
					require (File::build_path(array("view","view.php")));
				}
			}else{
				$view='error'; $pagetitle='ErreurProduit'; $errorType = "Create d'un Produit: Problème de paramètres";
				require (File::build_path(array("view","view.php")));
			}
		}

	


		public static function update(){
			if (isset($_GET['id'])){
				$p = ModelProduit::select($_GET['id']);

				if($p == false){
					$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'update Produit: id fourni non existant';
					require (File::build_path(array("view","view.php")));
				}
				else{

    				$pId = htmlspecialchars($p->get('id'));
    				$pNom =htmlspecialchars($p->get('nom'));
    				$pDescription = htmlspecialchars($p->get('description'));
    				$pPrix = htmlspecialchars($p->get('prix'));
    				$pNationalite = htmlspecialchars($p->get('nationalite'));
    				$pAction = "update";

					$view='update'; $pagetitle='Mise A Jour';
					require (File::build_path(array("view","view.php")));
				}
			}
			else{
				$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'update Produit: Problème de paramètres';
					require (File::build_path(array("view","view.php")));
			}
		}



		public static function updated(){
			if (isset($_GET['id']) && isset($_GET['nom']) && isset($_GET['description']) && isset($_GET['prix']) && isset($_GET['nationalite'])){
				$data = array(
					"id" => $_GET['id'],
					"nom" => $_GET['nom'],
					"description" => $_GET['description'],
					"prix" => $_GET['prix'],
					"nationalite" => $_GET['nationalite']
				);

				ModelProduit::update($data);

				$tab_p = ModelProduit::selectAll();
				$view='updated'; $pagetitle='Mise A Jour';
				require (File::build_path(array("view","view.php")));
			}
			else{
				$view='error'; $pagetitle='Erreur MAJ'; $errorType = 'updated Produit: Problème de paramètres';
					require (File::build_path(array("view","view.php")));
			}
		}
	}



?>