<?php

  require_once File::build_path(array("model", "Model.php"));

  class ModelUtilisateur extends Model{
           
    private $login;
    private $mdp;
    private $email;
    private $nom;
    private $prenom;
    private $ville;
    private $pays;
    private $adresse;
    private $dateDeNaissance;
    private $is_admin;
    private $nonce;
    protected static $object = 'utilisateur';
    protected static $primary='login';
              
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
      if (!is_null($data['login']) && !is_null($data['mdp']) && !is_null($data['email']) && !is_null($data['nom']) && !is_null($data['prenom']) && !is_null($data['ville']) && !is_null($data['pays']) && !is_null($data['adresse']) && !is_null($data['dateDeNaissance']) && !is_null($data['is_admin']) && !is_null($data['nonce'])) {
        // Si aucun de $m, $c et $i sont nuls,
        // c'est forcement qu'on les a fournis
        // donc on retombe sur le constructeur à 3 arguments
        $this->login = $data['login'];
        $this->mdp = $data['mdp'];
        $this->email = $data['email'];
        $this->nom = $data['nom'];
        $this->prenom = $data['prenom'];
        $this->ville = $data['ville'];
        $this->pays = $data['pays'];
        $this->adresse = $data['adresse'];
        $this->dateDeNaissance = $data['dateDeNaissance'];
        $this->is_admin = $data['is_admin'];
        $this->nonce = $data['nonce'];
      }
    }


    public function get_object_vars() {
        return get_object_vars($this);
    }



    public static function checkPassword($login,$mot_de_passe_chiffre){
      $sql ="SELECT COUNT(*) FROM utilisateur WHERE login=:login AND mdp=:motdepasse";


      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
        'login' => $login,
        'motdepasse' => $mot_de_passe_chiffre
      );


      $req_prep->execute($values);

      $req_prep->setFetchMode(PDO::FETCH_ASSOC);

      $resultat = $req_prep->fetchAll();
      
      if($resultat[0]['COUNT(*)'] == '1'){
        return true;
      }
      return false;
    
    }

 }

?>