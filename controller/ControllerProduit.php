<?php

	require_once (File::build_path(array("model","ModelProduit.php")));

	class ControllerProduit{
		protected static $object = 'produit';

		public static function readAll(){
			$tab_t = ModelProduit::selectAll(); 

			$view='list'; $pagetitle='Liste des Produits';
			require (File::build_path(array("view","view.php")));
		}




		public static function error(){
			$view='error'; $pagetitle='ErreurProduit';
			require (File::build_path(array("view","view.php")));
		}

	}



?>