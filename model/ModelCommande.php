<?php

require_once File::build_path(array("model", "Model.php"));

class ModelCommande extends Model{

    private $id;
    private $prixTotal;
    private $dateDeCommande;
    private $loginClient;
    protected static $object = 'commande';
    protected static $primary='id';

    //getter générique
    public function get($nom_attribut){
      return $this->$nom_attribut;
    }

    //setter générique
    public function set($nom_attribut,$value){
      $this->$nom_attribut = $value;
    }

    // un constructeur
    // La syntaxe ... = NULL signifie que l'argument est optionel
    // Si un argument optionnel n'est pas fourni,
    //   alors il prend la valeur par défaut, NULL dans notre cas
    public function __construct($data = NULL) {
        if (!is_null($data['id']) && !is_null($data['prixTotal']) && !is_null($data['loginClient']) && !is_null($data['dateDeCommande'])) {
            // Si aucun de $m, $c et $i sont nuls,
            // c'est forcement qu'on les a fournis
            // donc on retombe sur le constructeur à 3 arguments
            $this->id = $data['id'];
            $this->loginClient = $data['loginClient'];
            $this->dateDeCommande = $data['dateDeCommande'];
            $this->prixTotal = $data['prixTotal'];
        }
    }

    public function get_object_vars() {
        return get_object_vars($this);
    }


    public static function selectAllByLogin($login){
            //$sql = "SELECT * FROM eCom_commande C JOIN eCom_ligneCommande LC ON C.id = LC.idCommande WHERE C.loginClient = :login";
        $sql = "SELECT * FROM eCom_commande C WHERE C.loginClient = :login";

        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "login" => $login,
        );

            // On donne les valeurs et on exécute la requête   
        $req_prep->execute($values);

            // On récupère les résultats comme précédemment
        $req_prep->setFetchMode(PDO::FETCH_CLASS,"ModelCommande");

        return  $req_prep->fetchAll();
    }


    public static function selectProductCommande($id){
        $sql = "SELECT * FROM  eCom_ligneCommande LC JOIN eCom_produit P ON LC.idProduit = P.id WHERE LC.idCommande = :id";

        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "id" => $id,
        );

            
        try{ 
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return false;
        }
        return  $req_prep->fetchAll();
    }



    public static function save($data){

        $sql = "INSERT INTO eCom_commande(prixTotal, dateDeCommande, loginClient) VALUES (:prixTotal,:dateDeCommande,:loginClient);";
        $sql2 ="SELECT LAST_INSERT_ID() AS id FROM eCom_commande;";
        

        $req_prep = Model::$pdo->prepare($sql);
        $req_prep2 = Model::$pdo->prepare($sql2);


        try{
          $req_prep->execute($data);
          $req_prep2->execute();
          $req_prep2->setFetchMode(PDO::FETCH_ASSOC);
          $LastCreated = $req_prep2->fetchAll();

        }catch(PDOException $e) {
            return false;
        }
        return $LastCreated[0]['id'];
    }


    public static function saveProduitInCommande($idCommande,$idProduit,$quantite){

        $sql = "INSERT INTO eCom_ligneCommande(idCommande,idProduit,quantite) VALUES (:idCommande,:idProduit,:quantite);";

        $values = array(
                    'idCommande' => $idCommande, 
                    'idProduit' => $idProduit, 
                    'quantite' => $quantite, 
                );

        var_dump($values);
        $req_prep = Model::$pdo->prepare($sql);

        try{
          $req_prep->execute($values);
        }catch(PDOException $e) {
            return false;
        }
        return true;
    }

}

?>