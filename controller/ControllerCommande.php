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
				}else
				{
					$view='detail'; $pagetitle='Detail Commande';
				}
			}else{
				$view='error'; $pagetitle='ErreurCommande'; $errorType = "Read d'une Commande: Pas d'id fourni";
				
			}
			require (File::build_path(array("view","view.php")));
		}

		public static function create(){
			if(!Session::is_admin())self::error("Create d'une Commande: Acces Restreint<i class='material-icons left'>lock</i>");

			$cId = "\"\"";
			$cPrixTotal = "\"\"";
			$cDateDeCommande = "\"\"";
			$cLoginClient = "\"\"";
			$cAction = "create";
			
			$view='update'; $pagetitle='Creation Commande';
			require (File::build_path(array("view","view.php")));
		}



		public static function created(){
			if(!Session::is_admin())self::error("Created d'une Commande: Acces Restreint<i class='material-icons left'>lock</i>");
			
			if (is_null(myGet('prixTotal')) || is_null(myGet('dateDeCommande')) || is_null(myGet('loginClient')))self::error("Create d'un Commande: Problème de paramètres");

			$data = array(
				"id" => "",
				"prixTotal" => myGet('prixTotal'),
				"dateDeCommande" => myGet('dateDeCommande'),
				"loginClient" => myGet('loginClient')
			);
			
			$c = new ModelCommande($data);

			if(ModelCommande::save($c) == false)self::error('Created Produit: id fourni déjà existant');
			
			
			$tab_c = ModelCommande::selectAll();

			$view='created'; $pagetitle='Création Reussie';
			require (File::build_path(array("view","view.php")));
		}
		

	}



?>