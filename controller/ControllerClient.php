<?php

	require_once (File::build_path(array("model","ModelClient.php")));

	class ControllerClient{
		protected static $object = 'client';

		public static function readAll(){
			$tab_c = ModelClient::selectAll(); 

			$view='list'; $pagetitle='Liste des Clients';
			require (File::build_path(array("view","view.php")));
		}




		public static function error(){
			$view='error'; $pagetitle='ErreurClient';
			require (File::build_path(array("view","view.php")));
		}

	}



?>