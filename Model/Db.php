<?php
  // class connexion
  class Db {
    // déclaration des variables de connexion
    protected $dbName = 'learning_dollars_db'; /** Database Name */
    protected $dbHost = 'localhost'; /** Database Host */
    protected $dbUser = 'root'; /** Database Root */
    protected $dbPass = ''; /** Databse Password */
    protected $dbHandler, $dbStmt;

    //documentation php 
    /**
      * @param null|void
      * @return null|void
      * @desc Creates or resume an existing database connection...
    **/
    // fonction constructeur ne reçoit pas de paramétre et ne retourne rien
    public function __construct()
    {
      // Create a DSN Resource...
      $Dsn = "mysql:host=" . $this->dbHost . ';dbname=' . $this->dbName;
      //create a pdo options array
      $Options = array(
        //connexion persistent activé pour rend la conneexion plus rapide a chaque arrivée de script
        PDO::ATTR_PERSISTENT => true,
        //option utile lors du débogage pour trouver rapidement le problème
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );
      try {
        //création d'une instance pdo pour la connexion avec les paramètre de connexion
        $this->dbHandler = new PDO($Dsn, $this->dbUser, $this->dbPass, $Options);
        // avoir un message  en cas d'erreur 
      } catch (Exception $e) {
        var_dump('Couldn\'t Establish A Database Connection. Due to the following reason: ' . $e->getMessage());
      }
    }

    // la fonction reçoit une chaine de caractère et ne retourne rien
    /**
      * @param string
      * @return null|void
      * @desc Creates a PDO statement object
    **/
    // la fonction attends de recevoir une requete 
    public function query($query)
    {
      //l'objet appel une méthode de la class pdo nommé prepare pour preparer la requete
      $this->dbStmt = $this->dbHandler->prepare($query);
    }

    // la fontion reçoit un entier et une chaine de caractère  ne retourne rien
    /**
      * @param string|integer|
      * @return null|void
      * @desc Matches the correct datatype to the PDO Statement Object.
    **/
    //valeur par défaut de $type est null
    public function bind($param, $value, $type = null)
    {
      // si la variable est null
      if (is_null($type)) {

        switch (true) {
          // si la variable est un entier est vrai
          case is_int($value):
            // type de données INTEGER
            $type = PDO::PARAM_INT;
            // ON SORT DU SWITCH
          break;
          
          case is_bool($value):
            // type de données BOOLEAN
            $type = PDO::PARAM_BOOL;
          break;
          case is_null($value):
            // type de données NULL
            $type = PDO::PARAM_NULL;
          break;
          default:
          // type de données STRING
            $type = PDO::PARAM_STR;
          break;
        }
      }
      //RELIE PARAM A LA VALEUR ET CONSTANTE PDO::PARAM POUR LE TYPE QUI VIENT DU SWITCH
      $this->dbStmt->bindValue($param, $value, $type);
    }

    //la fonction ne reçoit pas de paramètre et ne retourne rien
    /**
      * @param null|void
      * @return null|void
      * @desc Executes a PDO Statement Object or a db query...
    **/
    public function execute()
    {
      //excute la requete 
      $this->dbStmt->execute();
      //returne true
      return true;
    }


    /**
      * @param null|void
      * @return null|void
      * @desc Executes a PDO Statement Object an returns a single database record as an associative array...
    **/
    public function fetch()
    {
      //excute la requete
      $this->execute();
      //retourne le resultat sous forme de tableau associatif
      return $this->dbStmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
      * @param null|void
      * @return null|void
      * @desc Executes a PDO Statement Object an returns nultiple database record as an associative array...
    **/
    public function fetchAll()
    {
      //excute la requete
      $this->execute();
      //retourne le resultat sous forme de tableau associatif 
      return $this->dbStmt->fetchAll(PDO::FETCH_ASSOC);
    }
  }
 ?>
