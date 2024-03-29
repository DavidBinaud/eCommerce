<?php
	//require_once '../config/Conf.php';
	require_once (File::build_path(array("config","Conf.php"))); // chargement du modèle
	class Model {

		public static $pdo;
		private static $prefixe = 'eCom_';


		public static function Init(){

			$hostname = Conf::getHostname();
			$database_name = Conf::getDatabase();
			$login = Conf::getLogin();
			$password = Conf::getPassword();

			try{
				// Connexion à la base de données            
				// Le dernier argument sert à ce que toutes les chaines de caractères 
				// en entrée et sortie de MySql soit dans le codage UTF-8
				self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
   
				// On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
				self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
			} catch(PDOException $e) {
  				if (Conf::getDebug()) {
    				echo $e->getMessage(); // affiche un message d'erreur
  				} else {
    				echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
				  }
				die();
			}

		}



	public static function selectAll(){

		$object_name = static::$object;
		$class_name = "Model" . ucfirst($object_name);

		
		$table_name = self::$prefixe . static::$object;


     	$rep = self::$pdo->query("SELECT * FROM {$table_name}");

      	$rep->setFetchMode(PDO::FETCH_CLASS, $class_name);

      	return  $rep->fetchAll();
    }





     public static function select($primary_value) {
	    	$table_name = self::$prefixe . static::$object;
			$class_name = "Model" . ucfirst(static::$object);
			$primary_key = static::$primary;

		    $sql = "SELECT * from {$table_name} WHERE {$primary_key}=:searched_value";
		    // Préparation de la requête
		    $req_prep = Model::$pdo->prepare($sql);

		    $values = array(
		        "searched_value" => $primary_value,
		    );

		    // On donne les valeurs et on exécute la requête   
		    $req_prep->execute($values);
		    
		    // On récupère les résultats comme précédemment
		    $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
		    $tab = $req_prep->fetchAll();
		    // Attention, si il n'y a pas de résultats, on renvoie false
		    if (empty($tab))
		        return false;
		    return $tab[0];
	    }



	    public static function delete($primary){
	    	$table_name = self::$prefixe . static::$object;
			$primary_key = static::$primary;


			$sql = "DELETE FROM $table_name WHERE $primary_key=:primary";

      		$req_prep = Model::$pdo->prepare($sql);

      		$values = array(
          		"primary" => $primary
      		);
      
      
        	$req_prep->execute($values);
	    }



	      public static function save($objectParam){
	     	$table_name = self::$prefixe . static::$object;
			$setOrder = '';
			$setTags = '';

			$values = $objectParam->get_object_vars();
			foreach ($values as $champ => $valeur){
				$setOrder = $setOrder . $champ .  ",";
				$setTags = $setTags . ":" . $champ . ",";
			}

			$setOrder = rtrim($setOrder,",");
			$setTags = rtrim($setTags,",");

      		$sql = "INSERT INTO $table_name ($setOrder) VALUES ($setTags)";
      		$req_prep = Model::$pdo->prepare($sql);
	
	      	
	      	
	      	try{
	      	  $req_prep->execute($values);
 			}catch(PDOException $e) {
	      	    if($e->getCode() == 23000){
	      	    	return false;
	      	    }
		    }
      		return true;
      		
    	}




    	public static function update($data){
	     	$table_name = self::$prefixe . static::$object;
			$primary_key = static::$primary;
			$set = '';
			foreach ($data as $champ => $valeur){
				$set = $set . $champ . "=:" . $champ . ",";
			}
			$set = rtrim($set,",");

	     	$sql = "UPDATE $table_name SET $set WHERE $primary_key=:$primary_key";

        	$req_prep = Model::$pdo->prepare($sql);
      
      		try{
        		$req_prep->execute($data);
        	}catch(PDOException $e){
        		return false;
        	}
        	return true;
	     }
	}
	Model::Init();
?>