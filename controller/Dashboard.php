<?php
  require_once(__dir__ . '/Controller.php');
  require_once('./Model/DashboardModel.php');
  class Dashboard extends Controller {

    public $active = 'dashboard'; 
    private $dashboardModel;

    /**
      * @param null|void
      * @return null|void
      * @desc 
    **/
    public function __construct()
    {
      if (!isset($_SESSION['auth_status'])) header("Location: index.php");
      $this->dashboardModel = new DashboardModel();
    }

    /**
      * @param null|void
      * @return array
      * @desc 
    **/
    public function getNews() :array
    {
      return $this->dashboardModel->fetchNews();
    }
  }
 ?>
