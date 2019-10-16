<?php

	require_once (File::build_path(array("model","ModelProduit.php")));

	class ControllerProduit{

		public static function readAll(){
			$tab_t = ModelProduit::selectAll(); 

			$controller='produit'; $view='list'; $pagetitle='Liste des Produits';
			require (File::build_path(array("view","view.php")));
		}




		public static function error(){
			$controller='produit'; $view='error'; $pagetitle='Erreur';
			require (File::build_path(array("view","view.php")));
		}

	}



?>