<?php

  require_once File::build_path(array("model", "Model.php"));

  class ModelProduit extends Model{
           
    private $id;
    private $nom;
    private $description;
    private $prix;
    private $nationalite;
    private $pathImgProduit;
    //private $type;
    protected static $object = 'produit';
    protected static $primary='id';
              
    //getter générique
    public function get($nom_attribut){
      return $this->$nom_attribut;
    }

    //setter générique
    public function set($nom_attribut,$value){
      $this->$nom_attribut = $value;
    }


    public function __construct($data = NULL) {
      if (!is_null($data['id']) && !is_null($data['nom']) && !is_null($data['description']) && !is_null($data['prix']) && !is_null($data['nationalite'])) {

            $this->id = $data['id'];
            $this->nom = $data['nom'];
            $this->description = $data['description'];
            $this->prix = $data['prix'];
            $this->nationalite = $data['nationalite'];
        }

        if(isset($data['pathImgProduit']) && !is_null($data['pathImgProduit'])){
            $this->pathImgProduit = $data['pathImgProduit'];
        }
    }


    public function get_object_vars() {
        return get_object_vars($this);
    }




    public static function search($chaineRecherchee){

        $sql = "SELECT * FROM eCom_produit WHERE nom LIKE :recherche";

        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
                "recherche" => "%" . $chaineRecherchee . "%",
            );

        $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelProduit");
        try{
            $req_prep->execute($values);
            $tab = $req_prep->fetchAll();
        }catch(PDOException $e){
            return array();
        }
        return $tab;
    }
}

?>