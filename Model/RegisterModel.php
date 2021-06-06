 <?php
  // inclure Db.php
  require_once(__dir__ . '/Db.php');

  // class RegisterModel herite de Db
  class RegisterModel extends Db {

    //la fonction createUser reçois un tableau et elle retourne un tableau
    /**
      * @param array
      * @return array
      * @desc 
    **/
    public function createUser(array $user) :array
    {
      // preparer la requete 
      $this->query("INSERT INTO `db_user` (name, email, phone_no, password) VALUES (:name, :email, :phone_no, :password)");
      // relier les variables 
      $this->bind('name', $user['name']);
      $this->bind('email', $user['email']);
      $this->bind('phone_no', $user['phone']);
      $this->bind('password', $user['password']);
      // si la requete est excutée
      if ($this->execute()) {
        // on stock le tableau associatif array status true
        $Response = array(
          'status' => true,
        );
        //retourne le tableau
        return $Response;
        //sinon retourne un tableau avec status false
      } else {
        $Response = array(
          'status' => false
        );
        return $Response;
      }
    }

    //la fonction fetchUser reçoit un string et retourne un tableau
    /**
      * @param string
      * @return array
      * @desc 
    **/
    public function fetchUser(string $email) :array
    {
      // preparer la requete
      $this->query("SELECT * FROM `db_user` WHERE `email` = :email");
      //relier les variables
      $this->bind('email', $email);
      // excuter la requete
      $this->execute();

      // on stock le resultat de la requete dans la variable $User
      $User = $this->fetch();

      //si la variable contient un resultat
      if (!empty($User)) {
        // on stock le tableau associatif array avec 'status' true et 'data' resultat de la requete
        $Response = array(
          'status' => true,
          'data' => $User
        );
        // on retourne le tableau
        return $Response;
      }

      // sinon returne  un tableau avec 'status' boolean false et 'data' tableau vide 
      return array(
        'status' => false,
        'data' => []
      );
    }
  }
 ?>
