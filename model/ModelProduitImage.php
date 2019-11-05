<?php

  require_once File::build_path(array("model", "Model.php"));

  class ModelProduitImage extends Model{
           
    private $idProduit;
    private $pathImgProduit;
    protected static $object = 'produitImage';
    protected static $primary='idProduit';
              
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
    public function __construct($id = NULL,$path = NULL) {
      if (!is_null($id) && !is_null($path)) {
        // Si aucun de $m, $c et $i sont nuls,
        // c'est forcement qu'on les a fournis
        // donc on retombe sur le constructeur à 3 arguments
        $this->idProduit = $id;
        $this->pathImgProduit = $path;
      }
    }


    public function get_object_vars() {
        return get_object_vars($this);
    }

 }

?>