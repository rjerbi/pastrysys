<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<?php include_once('layouts/header.php'); ?>

<style>
/* Video Background Styles */
.login-video-background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -1;
  object-fit: cover;
  opacity: 0.7; /* Adjust transparency */
}

.login-page {
  position: relative;
  z-index: 1;
  width: 300px;
  background-color: rgba(249, 249, 249, 0.58); /* Slightly transparent */
  border: 1px solid rgba(242, 242, 242, 0.8);
  box-shadow: 0 0 20px rgba(0,0,0,0.3);
}
</style>

<!-- Video Background -->
<video autoplay muted loop id="loginVideo" class="login-video-background">
  <source src="assets/videos/bg.mp4" type="video/mp4">
  <!-- Fallback image if video doesn't load -->
  <img src="assets/images/login-bg-fallback.jpg" alt="Login Background">
</video>

<div class="login-page">
    <div class="text-center">
       <h3>Connectez-vous pour continuer</h3>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="auth.php" class="clearfix">
        <div class="form-group">
              <label for="username" class="control-label">Nom d’utilisateur</label>
              <input type="name" class="form-control" name="username" placeholder="Nom utilisateur">
        </div>
        <div class="form-group">
            <label for="Password" class="control-label">Mot de passe</label>
            <input type="password" name= "password" class="form-control" placeholder="Mot de passe">
        </div>
        <div class="form-group">
                <button type="submit" class="btn btn-danger" style="border-radius:0%">Connexion</button>
        </div>
    </form>
</div>

<?php include_once('layouts/footer.php'); ?>