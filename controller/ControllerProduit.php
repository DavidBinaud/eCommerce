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
				}else
				{
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


	}



?>