<?php

	require_once (File::build_path(array("model","ModelCommande.php")));

	class ControllerCommande{

		public static function readAll(){
			$tab_c = ModelCommande::selectAll(); 

			$controller='commande'; $view='list'; $pagetitle='Liste des Commandes';
			require (File::build_path(array("view","view.php")));
		}




		public static function error(){
			$controller='commande'; $view='error'; $pagetitle='ErreurCommande';
			require (File::build_path(array("view","view.php")));
		}

	}



?>