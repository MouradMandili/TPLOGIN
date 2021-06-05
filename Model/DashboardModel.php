<?php
    //inclure php de la connexion
    require_once(__dir__ . '/Db.php');
    // class DashboardModel hérite de la class Db
    class DashboardModel extends Db {
      // la fonctoin fetchNews ne reçoit pas de paramètre et elle retourne unn tableau
      /**
        * @param null
        * @return array
        * @desc 
      **/
      public function fetchNews() :array
      {
        //preparation de la requete
        //la requete va chercher toutes les colonnes de la table db_news et les trier par ordre descendant        
        $this->query("SELECT * FROM `db_news` ORDER BY `id` DESC");
        // on excute la requete
        $this->execute();
        // on stock le resultat de la requête dans la variable $News
        $News = $this->fetchAll();
        
        //si $new contient un resultat
        if (count($News) > 0) {
          // dans la variable $Response on stock le tableau array 
          $Response = array(
            //1er element boolean true
            'status' => true,
            // 2ème element le resultat de la requete
            'data' => $News
          );
          //on retourn le tableau et on sort de la fonction
          return $Response;
        }
        //sinon on fait la meme chose mais en mettant le boolean à false et le data en tableau vide et en retourne le tableau array
        $Response = array(
          'status' => false,
          'data' => []
        );
        return $Response;
      }
      
    }
 ?>
