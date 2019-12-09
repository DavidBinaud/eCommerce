<?php

	require_once (File::build_path(array("model","ModelCommande.php")));

	class ControllerCommande{
		protected static $object = 'commande';

		public static function error($errorType = NULL,$object=NULL,$redirect = NULL,$parametres = NULL){

			if (!is_null($object)) {
				$object = self::$object;
			}


			//pour chaque element dans $parametre on va créer une variable nommé avec le nom de la clé et contenant comme valeur la valeur associée à cette clé
			if(!is_null($parametres) && is_array($parametres)){
				foreach ($parametres as $key => $value) {
					${$key} = $value;
				}
			}
			$hasRedirect = !is_null($redirect); // Used to check in error view if a redirection exists

			$view='error'; $pagetitle='Produit';;
			require (File::build_path(array("view","view.php")));
			die();
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
			if(!Session::is_admin()) {
				self::error("Create d'une Commande: Acces Restreint<i class='material-icons left'>lock</i>");
			}

			$cId = "\"\"";
			$cPrixTotal = "\"\"";
			$cDateDeCommande = "\"\"";
			$cLoginClient = "\"\"";
			$cAction = "create";
			
			$view='update'; $pagetitle='Creation Commande';
			require (File::build_path(array("view","view.php")));
		}



		public static function created(){
			if(!Session::is_admin()) {
				self::error("Created d'une Commande: Acces Restreint<i class='material-icons left'>lock</i>");
			}
			
			if (!isset($_SESSION['panier']) && empty($_SESSION['panier'])) {
				self::error("Create d'une Commande: Panier Vide","produit","panier");
			}

			$data = array(
				"id" => '',
				"prixTotal" => $_SESSION['prixpanier'],
				"dateDeCommande" => date('Y-m-d'),
				"loginClient" => $_SESSION['login']
			);
			var_dump($data);
			
			$c = new ModelCommande($data);

			var_dump($c);
			if(ModelCommande::save($c) == false) {
				self::error('Created Commande: id fourni déjà existant');
			}
			
			$tab_c = ModelCommande::selectAll();

			$view='created'; $pagetitle='Création Reussie';
			require (File::build_path(array("view","view.php")));
		}

		public static function delete(){
			if(!Session::is_admin()) {
				self::error("Delete d'une Commande: Acces Restreint<i class='material-icons left'>lock</i>");
			}

			if(is_null(myGet('id'))) {
				self::error("Delete d'une Commande: Pas d'id fourni");
			}

			$c = ModelCommande::select(myGet('id'));
			if($c == false) {
				self::error("Delete d'un Commande: id fourni non existant");
			}


			ModelCommande::delete(myGet('id'));
			$tab_c = ModelCommande::selectAll();

			$view='delete'; $pagetitle='Suppresion Commande';
			require (File::build_path(array("view","view.php")));
		}

		public static function update(){
			if(!Session::is_admin()) {
				self::error("update Commande: Acces Restreint<i class='material-icons left'>lock</i>");
			}
			
			if (is_null(myGet('id'))) {
				self::error('update Commande: Problème de paramètres');
			}
			
			$c = ModelCommande::select(myGet('id'));
			if($c == false) {
				self::error('update Commande: id fourni non existant');
			}

			$cId = htmlspecialchars($c->get('id'));
			$cPrixTotal = htmlspecialchars($c->get('prixTotal'));
			$cDateDeCommande = htmlspecialchars($c->get('dateDeCommande'));
			$cLoginClient = htmlspecialchars($c->get('loginClient'));
			$cAction = "update";

			$view='update'; $pagetitle='Mise A Jour';
			require (File::build_path(array("view","view.php")));
		}



		public static function updated(){
			if(!Session::is_admin()) {
				self::error("updated Commande: Acces Restreint<i class='material-icons left'>lock</i>");
			}
			
			if (is_null(myGet('id')) || is_null(myGet('prixTotal')) || is_null(myGet('dateDeCommande')) || is_null(myGet('loginClient')))self::error('updated Commande: Problème de paramètres');
			
			if (ModelCommande::select(myGet('id')) == false) {
				self::error('updated Commande: id Commande non existant');
			}

			$data = array(
				"id" => myGet('id'),
				"prixTotal" => myGet('prixTotal'),
				"dateDeCommande" => myGet('dateDeCommande'),
				"loginClient" => myGet('loginClient')
			);
			
			
			if(!ModelCommande::update($data)) {
				self::error('updated Commande: Probleme rencontré lors de la maj');
			}
			
			$tab_c = ModelCommande::selectAll();


			$view='updated'; $pagetitle='Mise A Jour';
			require (File::build_path(array("view","view.php")));
		}
	}
?>