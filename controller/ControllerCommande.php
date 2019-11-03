<?php

	require_once (File::build_path(array("model","ModelCommande.php")));

	class ControllerCommande{
		protected static $object = 'commande';

		public static function error(){
			$view='error'; $pagetitle='ErreurCommande'; $errorType = "Erreur Générale";
			require (File::build_path(array("view","view.php")));
		}

		public static function readAll(){
			$tab_c = ModelCommande::selectAll(); 

			$view='list'; $pagetitle='Liste des Commandes';
			require (File::build_path(array("view","view.php")));
		}



		public static function read(){
			if(isset($_GET['id'])){
				$c = ModelCommande::select($_GET['id']);
				if($c == false){
					
					$view='error'; $pagetitle='ErreurCommande'; $errorType = "Read d'une Commande: id fourni non existant";
					require (File::build_path(array("view","view.php")));
				}else
				{
					$view='detail'; $pagetitle='Detail Commande';
					require (File::build_path(array("view","view.php")));
				}
			}else{
				$view='error'; $pagetitle='ErreurCommande'; $errorType = "Read d'une Commande: Pas d'id fourni";
				require (File::build_path(array("view","view.php")));
			}
		}
		

	}



?>