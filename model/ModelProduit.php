<?php

  require_once File::build_path(array("model", "Model.php"));

  class ModelProduit extends Model{
           
    private $id;
    private $nom;
    private $description;
    private $prix;
    private $nationalite;
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

    // un constructeur
    // La syntaxe ... = NULL signifie que l'argument est optionel
    // Si un argument optionnel n'est pas fourni,
    //   alors il prend la valeur par défaut, NULL dans notre cas
    public function __construct($data = NULL) {
      if (!is_null($data['id']) && !is_null($data['nom']) && !is_null($data['description']) && !is_null($data['prix']) && !is_null($data['nationalite'])) {
        // Si aucun de $m, $c et $i sont nuls,
        // c'est forcement qu'on les a fournis
        // donc on retombe sur le constructeur à 3 arguments
        $this->id = $data['id'];
        $this->nom = $data['nom'];
        $this->description = $data['description'];
        $this->prix = $data['prix'];
        $this->nationalite = $data['nationalite'];
      }
    }


    public function get_object_vars() {
        return get_object_vars($this);
    }



    public function get_img_path() {
            $sql = "SELECT imgproduit FROM eCom_imgproduit WHERE idProduit=:searched_id";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "searched_id" => $this->id,
            );

            // On donne les valeurs et on exécute la requête   
            $req_prep->execute($values);

            // On récupère les résultats comme précédemment
            $req_prep->setFetchMode(PDO::FETCH_NUM);
            $tab = $req_prep->fetch();
            // Attention, si il n'y a pas de résultats, on renvoie false
            if (empty($tab))
                return false;
            return $tab[0];
    }
 }

?>