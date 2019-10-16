<?php

  require_once File::build_path(array("model", "Model.php"));

  class ModelCommande extends Model{
           
    private $id;
    private $quantite;
    private $prix;
    private $dateDeCommande;
    private $idClient;
    protected static $object = 'commande';
              
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
      if (!is_null($data['id']) && !is_null($data['quantite']) && !is_null($data['prix']) && !is_null($data['dateDeCommande']) && !is_null($data['idClient'])) {
        // Si aucun de $m, $c et $i sont nuls,
        // c'est forcement qu'on les a fournis
        // donc on retombe sur le constructeur à 3 arguments
        $this->id = $data['id'];
        $this->quantite = $data['quantite'];
        $this->prix = $data['prix'];
        $this->dateDeCommande = $data['dateDeCommande'];
        $this->idClient = $data['idClient'];
      }
    }
 }

?>