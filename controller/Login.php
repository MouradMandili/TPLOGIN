<?php
// inclus les fichiers Controller.php LoginModel.php
require_once(__dir__ . '/Controller.php');
require_once('./Model/LoginModel.php');
// class Login herite de la class Controller
class Login extends Controller {
  //
  // declaration de variable public accessible par des tiers
  public $active = 'login'; 
  // declaration de variable private accessible que dans la class
  private $loginModel;
  // le constructeur de prends pas de paramètre et ne return rien
  /**
    * @param null|void
    * @return null|void
    * @desc 
  **/
  public function __construct()
  {
    // si le tableau $_SESSION est defini et != null alors on redirige vers la page dashboard.php
    if (isset($_SESSION['auth_status'])) header("Location: dashboard.php");
    // on céer un objet de la class 
    $this->loginModel = new LoginModel();
  }

  // la fonction reçois un tableau et return un tableau contient un boolean
  /**
    * @param array
    * @return array|boolean
    * @desc 
  **/
  // déclaration de la fonction (parametre entrant de type tableau)
  public function login(array $data)
  {
    //mettre les valeurs récupérés dans email et password en supprimant les antislachs et les balise html php
    $email = stripcslashes(strip_tags($data['email']));
    $password = stripcslashes(strip_tags($data['password']));

    // L'objet de la class LoginModel appel la fonction fetchEmail lui donne l'email en string, elle retournera 
    // un tableau qu'on va stocker dans la variable $EmailRecords 
    $EmailRecords = $this->loginModel->fetchEmail($email);

    //si status == false 
    if (!$EmailRecords['status']) {
      // si le mot de passe correspond au hashage
      if (password_verify($password, $EmailRecords['data']['password'])) {
        // on stock le tableau  associatif avec un element boolean à true dans la variable $Response
        $Response = array(
          'status' => true
        );

        //en stock l'email dans le tableau $_SESSION
        $_SESSION['data'] = $EmailRecords['data'];
        // on met l'element 'auth_status' à true
        $_SESSION['auth_status'] = true;
        // on redirige l'utisateur vers la page dashboard.php
        header("Location: dashboard.php");
      }

       // sinon on stock le tableau  associatif avec un element boolean à false dans la variable $Response
      $Response = array(
        'status' => false,
      );
      return $Response;
    }

  //   $Response = array(
  //     'status' => false,
  //   );
  //   return $Response;
  // }
}
 ?>
