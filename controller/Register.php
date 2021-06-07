<?php
  //inclure Controller.php et RegisterModel.php
  require_once(__dir__ . '/Controller.php');
  require_once('./Model/RegisterModel.php');
  // class Register hérite de la class Controller
  class Register extends Controller {
    // declaration de variable
    public $active = 'Register'; 
    private $registerModel;

    // fonction constructeur ne reçois pas de paramétre et elle ne retourne rien
    /**
      * @param null|void
      * @return null|void
      * @desc 
    **/
    public function __construct()
    {
      //si le tableau $_SESSION est definie et != de null alors on redirige vers la page dashboard.php
      if (isset($_SESSION['auth_status'])) header("Location: dashboard.php");
      //on creer un objet à partir de la class RegisterModel()
      $this->registerModel = new RegisterModel();
    }

      //la fonction register reçoit un tableau et elle retourne un tableau de boolean
    /**
      * @param array
      * @return array|boolean
      * @desc .
    **/
    public function register(array $data)
    {
      // on supprime les antislash et les balise html php et on stock ce qui a été saisi dans les variables
      $name = stripcslashes(strip_tags($data['name']));
      $email = stripcslashes(strip_tags($data['email']));
      $phone = stripcslashes(strip_tags($data['phone']));
      $password = stripcslashes(strip_tags($data['password']));

      //objet de la class RegisterModel() fait appel à la fonction fechUser, on stock le tableau retourné par cette fonction dans
      // la variable $EmailStatus
      $EmailStatus = $this->registerModel->fetchUser($email)['status'];

      //on crée une variable $Error dans laquelle on mets un tableau associatif avec 4 elements vide  et le status a false
      $Error = array(
        'name' => '',
        'email' => '',
        'phone' => '',
        'password' => '',
        'status' => false
      );

      //on verifie si le nom contient que des lettres
      if (preg_match('/[^A-Za-z\s]/', $name)) {
        $Error['name'] = 'Only Alphabets are allowed.';
        return $Error;
      }

      //si $EmailStatus n'est pas vide alors ce mail existe déja
      if (!empty($EmailStatus)) {
        $Error['email'] = 'Sorry. This Email Address has been taken.';
        return $Error;
      }

      //on verifie si le numero de téléphone ne contient que des chiffre de 0 à 9
      if (preg_match('/[^0-9_]/', $phone)) {
        $Error['phone'] = 'Please, use a valid phone number.';
        return $Error;
      }

      // si le mot de passe est inferieur à 8 caractère on demande de choisir un mot de passe plus fort
      if (strlen($password) < 7) {
        $Error['password'] = 'Please, use a stronger password.';
        return $Error;
      }

      //si toute est ok alors on mets nos variables dans un tableau et on les stocks dans la variable $Payload
      $Payload = array(
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        // cette fonction sert à hasher le mot de passe
        'password' => password_hash($password, PASSWORD_BCRYPT)
      );

      //l'objet appel la fonction qui nous retourne un tableau avec 'status' true (excution de la requete est ok) ou false dans le cas contraire
      $Response = $this->registerModel->createUser($Payload);

      //l'objet appel la fonction pour aller chercher les infos dans la base de données qui correspond au paramétre entrant
      // ici la fonction retourn un tableau mais on stock dans la variable $Data que le deuxième
      // éléments du tableau 'data' ou il y a le resultat de la requet 
      $Data = $this->registerModel->fetchUser($email)['data'];
      //on détruit le mot de passe 
      unset($Data['password']); 

      //si $Response['status'] est false alors la requete ne s'est pas executé
      if (!$Response['status']) {
        $Response['status'] = 'Sorry, An unexpected error occurred and your request could not be completed.';
        //on retourne le tableau
        return $Response;
      }

      //sinon stock les données dans le tableau associatif $_SESSION 'data' 
      $_SESSION['data'] = $Data;
      //on met 'auth_status' = true;
      $_SESSION['auth_status'] = true;
      //on redirige l'utisateur vers la page dashboard.php
      header("Location: dashboard.php");
      // on retourne true
      return true;
    }
  }
 ?>
