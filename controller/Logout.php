<?php
  // inclure fichier Controller.php
  require_once(__dir__ . '/Controller.php');
  //class Logout hérite de Controlleur
  class Logout extends Controller {
    //la fonction contstructeur ne reçoit rien et ne renvoie rien 
    /**
      * @param null|void
      * @return null|void
      * @desc 
    **/
    public function __construct()
    {
      //  détruire la session
      session_destroy();
      // rediriger vers pas index
      header("Location: index.php");
    }
  }
 ?>
