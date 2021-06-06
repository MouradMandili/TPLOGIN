<?php
  //inclure Controller.php et DashboardModel.php
  require_once(__dir__ . '/Controller.php');
  require_once('./Model/DashboardModel.php');
  //class Dashbord herite de la class Controller
  class Dashboard extends Controller {
    // affecte 'dashboard' à la variable public $active
    public $active = 'dashboard'; 
    // declaration de la variable $dashboardModel
    private $dashboardModel;

    // la foction constructeur ne prends pas de parametre et ne retourne rien
    /**
      * @param null|void
      * @return null|void
      * @desc 
    **/
    public function __construct()
    {
      // si le tableau $_SESSION n'est pas defini ou ==null, on revoie vers la page index
      if (!isset($_SESSION['auth_status'])) header("Location: index.php");
      // on creer une instance de la class DashboardModel
      $this->dashboardModel = new DashboardModel();
    }

    // cette fonction ne prends pas de paramétre et il return un tableau
    /**
      * @param null|void
      * @return array
      * @desc 
    **/
    public function getNews() :array
    {
      // le tableau avec deux elements 'status' est un booleen et 'data' ou on a le resultat de la requete
      return $this->dashboardModel->fetchNews();
    }
  }
 ?>
