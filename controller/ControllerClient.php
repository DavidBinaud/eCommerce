<?php

	require_once (File::build_path(array("model","ModelClient.php")));

	class ControllerClient{

		public static function readAll(){
			$tab_c = ModelClient::selectAll(); 

			$controller='client'; $view='list'; $pagetitle='Liste des Clients';
			require (File::build_path(array("view","view.php")));
		}




		public static function error(){
			$controller='client'; $view='error'; $pagetitle='Erreur';
			require (File::build_path(array("view","view.php")));
		}

	}



?>