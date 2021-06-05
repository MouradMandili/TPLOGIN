<!-- inclure le ficher php -->
<?php require_once('./controller/Dashboard.php'); ?>
<?php
  //creer un objet de la class Dashboard
  $Dashboard = new Dashboard();
  //initialisé la variable avec un tableau vide
  $Response = [];
  //stock l'attribut active de la class Dashboard vu qu'il public, dans la variable $active 
  $active = $Dashboard->active;
  // on affecte le tableau du resultat de requete dans la variable news
  $News = $Dashboard->getNews();
?>
<!-- inclure le fichier nav.php -->
<?php require('./nav.php'); ?>
<main role="main" class="container">
  <div class="container">
    <div class="row mt-5">
      <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
        <h2>News</h2>
        <hr>
      </div>
    </div>
    <div class="row">
      <!-- si le $News['status'] est true ce qui correspond un tableau plein -->
      <?php if ($News['status']) : ?>
      <!-- pour chaque element (ligne de la raquete) du tableau -->
        <?php foreach ($News['data'] as $new) :  ?>
          <div class="col-xs-12 col-sm-12 col-md-12 col-xl-4 col-lg-4">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded">
              <div class="news_title">
                <!-- on affiche le contenu de la colonne "title" de chaque ligne -->
                <h3><?php echo ucwords($new['title']); ?></h3>
              </div>
              <div class="news_body">
                <!-- on affiche le contenu de la colonne "content" de chaque ligne -->
                <p><?php echo $new['content']; ?> <a href="javascript:void(0)">Read More</a></p>
              </div>
            </div>
          </div>
          <!-- fin de la boucle foreach -->
        <?php endforeach; ?>
        <!-- fin de la boucle if -->
      <?php endif;  ?>
    </div>
  </div>
</main>
</body>
</html>
