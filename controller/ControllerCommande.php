<?php

	require_once (File::build_path(array("model","ModelCommande.php")));

	class ControllerCommande{
		protected static $object = 'commande';

		public static function readAll(){
			$tab_c = ModelCommande::selectAll(); 

			$view='list'; $pagetitle='Liste des Commandes';
			require (File::build_path(array("view","view.php")));
		}




		public static function error(){
			$view='error'; $pagetitle='ErreurCommande';
			require (File::build_path(array("view","view.php")));
		}

	}



?>