<?php

	require_once (File::build_path(array("model","ModelClient.php")));

	class ControllerClient{
		protected static $object = 'client';

		public static function error(){
			$view='error'; $pagetitle='ErreurClient'; $errorType = "Erreur Générale";
			require (File::build_path(array("view","view.php")));
		}



		public static function readAll(){
			$tab_c = ModelClient::selectAll(); 

			$view='list'; $pagetitle='Liste des Clients';
			require (File::build_path(array("view","view.php")));
		}



		public static function read(){
			if(isset($_GET['id'])){
				$c = ModelClient::select($_GET['id']);
				if($c == false){
					
					$view='error'; $pagetitle='ErreurClient'; $errorType = "Read d'un Client: id fourni non existant";
					require (File::build_path(array("view","view.php")));
				}else
				{
					$view='detail'; $pagetitle='Detail Client';
					require (File::build_path(array("view","view.php")));
				}
			}else{
				$view='error'; $pagetitle='ErreurClient'; $errorType = "Read d'un Client: Pas d'id fourni";
				require (File::build_path(array("view","view.php")));
			}
		}



		public static function delete(){
			if(isset($_GET['id'])){
				$c = ModelClient::select($_GET['id']);
				if($c == false){
					$view='error'; $pagetitle='ErreurProduit'; $errorType = "Delete d'un Client: id fourni non existant";
					require (File::build_path(array("view","view.php")));
				}else{
					ModelClient::delete($_GET['id']);
					$tab_c = ModelClient::selectAll();

					$view='delete'; $pagetitle='Suppresion Clients';
					require (File::build_path(array("view","view.php")));
				}
			}else{
				$view='error'; $pagetitle='ErreurClients'; $errorType = "Delete d'un Clients: Pas d'id fourni";
				require (File::build_path(array("view","view.php")));
			}
		}


	}



?>