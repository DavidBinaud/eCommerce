<?php

  require_once File::build_path(array("model", "Model.php"));

  class ModelClient extends Model{
           
    private $id;
    private $nom;
    private $prenom;
    private $ville;
    private $pays;
    private $adresse;
    private $dateDeNaissance;
    protected static $object = 'client';
              
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
      if (!is_null($data['id']) && !is_null($data['nom']) && !is_null($data['prenom']) && !is_null($data['ville']) && !is_null($data['pays']) && !is_null($data['adresse']) && !is_null($data['dateDeNaissance'])) {
        // Si aucun de $m, $c et $i sont nuls,
        // c'est forcement qu'on les a fournis
        // donc on retombe sur le constructeur à 3 arguments
        $this->id = $data['id'];
        $this->nom = $data['nom'];
        $this->prenom = $data['prenom'];
        $this->ville = $data['ville'];
        $this->pays = $data['pays'];
        $this->adresse = $data['adresse'];
        $this->dateDeNaissance = $data['dateDeNaissance'];
      }
    }
 }

?>