<!-- inclure config.php -->
<?php require_once('./config.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="application-name" content="LD Talent Login Project">
    <meta name="author" content="Ilori Stephen A">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- affiche la variable avec la première lettre en majuscule -->
    <title>LD Talent | <?php echo ucfirst($active); ?></title>
    <!-- Css Styles... -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Script -->
    <script src="./assets/js/jquery.js" charset="utf-8"></script>
    <script src="./assets/js/bootstrap.min.js" charset="utf-8"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">LD Talent</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav ml-auto">
          <!-- si le tableau associatif est défini et != de null -->
            <?php if (!isset($_SESSION['auth_status'])) : ?>
              <li class="nav-item">
                <!-- si le miniscule de la variable égale à 'login' alors la balise a renvoi vers la page index.php-->
                <a class="nav-link <?php if (strtolower($active) === 'login') echo 'active'; ?>" href="<?php echo BASE_URL; ?>index.php">Login</a>
              </li>
              <li class="nav-item">
              <!-- si le miniscule de la variable égale à 'register' alors la balise a renvoi vers la page register.php-->
                <a class="nav-link <?php if (strtolower($active) === 'register') echo 'active'; ?>" href="<?php echo BASE_URL; ?>register.php" tabindex="-1" aria-disabled="true">Register</a>
              </li>
              <!-- sinon -->
            <?php elseif (isset($_SESSION['auth_status'])) : ?>
              <li class="nav-item">
              <!-- le lien de la balise a renvoie vers la page dashboard.php / si le miniscule de la variable égale à dashboard affiche active -->
                <a href="<?php echo BASE_URL; ?>dashboard.php" class="nav-link <?php if (strtolower($active) === 'dashboard') echo 'active'; ?>">Dashboard</a>
              </li>
              <!-- fin de si -->
            <?php endif; ?>
            <!-- si le tableau n'est pas défini ou null -->
            <?php if (isset($_SESSION['auth_status'])) : ?>
              <li class="nav-item">
                <!-- le lien de a renvoie vers la page Logout.php -->
                <a class="nav-link" href="<?php echo BASE_URL; ?>logout.php">Logout</a>
              </li>
              <!-- fin de if -->
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
