<?php

	require_once (File::build_path(array("model","ModelCommande.php")));
	require_once (File::build_path(array("model","ModelPanier.php")));
	require_once (File::build_path(array("lib","Date.php")));

	class ControllerCommande{
		protected static $object = 'commande';

		public static function error($errorType = NULL,$object=NULL,$redirect = NULL,$parametres = NULL){

			if (is_null($object)) {
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
			if(!Session::is_admin()){
				self::error("ReadAll d'une Commande: Acces Restreint<i class='material-icons left'>lock</i>");
			}

			$tab_c = ModelCommande::selectAll(); 

			$view='list'; $pagetitle='Liste des Commandes';
			require (File::build_path(array("view","view.php")));
		}


		public static function readByLogin(){
			if(is_null(myGet('login'))){
				self::error("ReadByLogin d'une Commande: Pas de login fourni");
			}

			if(!Session::is_user(myGet('login'))){
				self::error("ReadByLogin d'une Commande: Accès Restreint");
			}

			
			$tab_c = ModelCommande::selectAllByLogin(myGet('login'));

			$view='list'; $pagetitle='Liste de Vos Commandes';
			require (File::build_path(array("view","view.php")));
		}




		public static function read(){
			if(is_null(myGet('id'))){
				self::error("Read d'une Commande: Pas d'id fourni");
			}

			if(!isset($_SESSION['login'])){
				self::error("Read d'une Commande: Accès Restreint, Veuillez vous connecter","utilisateur","connect");
			}
			
			$c = ModelCommande::select(myGet('id'));
			
			if($c == false){
				self::error("Read d'une Commande: id fourni non existant");
			}

			if($c->get('loginClient') != $_SESSION['login'] && !Session::is_admin()){
				self::error("Read d'une Commande: Accès Restreint, ce compte n'est pas le votre");
			}
			
			$tab_produitCommande = ModelCommande::selectProductCommande(myGet('id'));

			$cid = htmlspecialchars($c->get("id"));
			$cprix = htmlspecialchars($c->get("prixTotal"));
			$cdateDeCommande = Date::formate($c->get("dateDeCommande"));
			$cidClient = htmlspecialchars($c->get("loginClient"));


			$view='detail'; $pagetitle='Detail Commande';
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
			if(!isset($_SESSION['login'])) {
				self::error("Created d'une Commande: Acces Restreint, Veuillez vous connecter<i class='material-icons left'>lock</i>","utilisateur","connect",array('login' => ""));
			}
			
			if (!isset($_SESSION['panier']) || empty($_SESSION['panier']['produits'])) {
				self::error("Create d'une Commande: Panier Vide","produit","panier",array('panier_is_empty' => ModelPanier::is_empty()));
			}

			$data = array(
				"prixTotal" => $_SESSION['panier']['prixTotal'],
				"dateDeCommande" => date('Y-m-d'),
				"loginClient" => $_SESSION['login']
			);
			
			$cId = ModelCommande::save($data);
			if($cId == false) {
			//if(ModelCommande::save($data) == false) {
				self::error('Created Commande: Problème avec le serveur');
			}

			foreach ($_SESSION['panier']['produits'] as $produit) {
				ModelCommande::saveProduitInCommande($cId,$produit['id'],$produit['quantité']);
			}

			ModelPanier::emptyPanier();
			$tab_c = ModelCommande::selectAllByLogin($_SESSION['login']);

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
			
			if (is_null(myGet('id')) || is_null(myGet('prixTotal')) || is_null(myGet('dateDeCommande')) || is_null(myGet('loginClient'))){
				self::error('updated Commande: Problème de paramètres');
			}

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