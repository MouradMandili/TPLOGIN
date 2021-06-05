<?php
  // inclus fichier Db.php __DIR__ est une constant qui indique le répertoire du fichier courant
  require_once(__dir__ . '/Db.php');
  // class LoginModel hérite de la class Db
  class LoginModel extends Db {
    // docphp pour indiquer le type de paramètre entrant et sortant de la fonction
    /**
      * @param string
      * @return array
      * @desc 
    **/
    // fonction reçois une chaine de caractère et retour un tableau
    public function fetchEmail(string $email) :array
    {
      //preparation de la requete 
      //la requete va aller chercher dans la table db_user un email à condition qu'il soit égal un email qu'on ne sais pas encore sa valeur
      $this->query("SELECT * FROM `db_user` WHERE `email` = :email");
      // on relie le parametre entrant avec la valeur attendue
      $this->bind('email', $email);
      // on excecute la requete
      $this->execute();

      // en stock la ligne récupéré dans la variable $Email
      $Email = $this->fetch();
      //si la variable est vide 
      if (empty($Email)) {
        //tu me stock le tableau associatif array dans la variable $Response
        $Response = array(
          //premier element du tableau est un boolean mit à true
          'status' => true,
          //deuxiéme element du tableau  est une variable qui contient le résultat de la requéte
          'data' => $Email
        );
        //on retourne le tableau
        return $Response;
      }
      //si la variable n'est pas vide
      if (!empty($Email)) {
        //tu me stock le tableau associatif array dans la variable $Response
        $Response = array(
           //premier element du tableau est un boolean mit à false
          'status' => false,
          //deuxiéme element du tableau  est une variable qui contient le résultat de la requéte
          'data' => $Email
        );
        //on retourne le tableau
        return $Response;
      }
    }
  }
 ?>
