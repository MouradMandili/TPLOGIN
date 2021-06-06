<?php 
  // inclus le fichier Login.php
  require_once('./controller/Login.php'); 
?>
<?php
  // créer un objet de la class Login
  $Login = new Login();
  // init la variable avec un tableau vide
  $Response = [];
  //assign la propriété active de l'objet Login dans la variable $active
  $active = $Login->active;
  //si $_POST est definie et different de null et le tableau $_POST n'est pas vide
  // l'objet $Login appel la fonction login en lui donnant le tableau $_POST en parametre entrant 
  // et retourne un tableau qu'on stock dans la variable $Response
  if (isset($_POST) && count($_POST) > 0) $Response = $Login->login($_POST);
?>
  <!-- inclure nav.php -->
  <?php require('./nav.php'); ?>
    <main role="main" class="container">
      <div class="container">
        <div class="row justify-content-center mt-10">
          <div class="col-xs-12 col-sm-12 col-md-12 col-xl-4 col-lg-4 center-align center-block">
          <!-- si le tableau est defini et != null et status == false -->
            <?php if (isset($Response['status']) && !$Response['status']) : ?>
            <div class="alert alert-danger" role="alert">
            <!-- les identifiants ne sont pas valide -->
              <span><B>Oops!</B> Invalid Credentials Used.</span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-danger">&times;</span>
              </button>
            </div>
            <!-- fin du if -->
            <?php endif; ?>
            <div class="card shadow-lg p-3 mb-5 bg-white rounded">
            <!-- tu dirige ton $_POST vers la page elle même -->
              <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-signin">
              <h4 class="h3 mb-3 font-weight-normal text-center">Sign in</h4>
              <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
                <div class="form-group">
                  <label for="inputEmail" class="sr-only">Email address</label>
                  <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
                <div class="form-group">
                  <label for="inputPassword" class="sr-only">Password</label>
                  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
                <button class="btn btn-md btn-primary btn-block" type="submit">Sign in</button>
              </div>
              <p class="mt-5 text-center mb-3 text-muted">&copy; Ilori Stephen A <?php echo date('Y'); ?></p>
            </form>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
  </html>
