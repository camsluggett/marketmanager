<?php
require_once './config/config.php';

if ($_POST["submit"])
{
  $sql = $db->prepare("SELECT * FROM users WHERE email=?");
  $sql->execute([$_POST["email"]]);
  $res = $sql->fetch();
  $admin = $res['is_admin'];
  if (!password_verify($_POST["password"], $res["password"]))
  {
    $sign_in_alert = '<p class="text-danger">Email and password combination are incorrect.</p>';
  }
  else
  {
    $_SESSION["authenticated_user"] = $res["id"];

    if ($admin == '1') {
      $_SESSION['isAdmin'] = true;
      header("location: admin.php ");
    } else {
      header("location: markets.php ");
    }



  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign In - Arkitu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Arkitu">
    <meta name="keywords" content="arkitu">

    <!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/logo.png">
		<!-- Author Meta -->
		<meta name="author" content="codepixer">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Saas</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/nice-select.css">
			<link rel="stylesheet" href="css/animate.min.css">
			<link rel="stylesheet" href="css/owl.carousel.css">
			<link rel="stylesheet" href="css/main.css">
  </head>
  <body>
    <br>

    <div class="container">
      <div class="row align-items-center justify-content-between d-flex">
        <div id="logo">
          <a href="index.html"><img src="img/logoMM.png" width: "50" height: "50" alt="" title="" /></a>
        </div>
        <nav id="nav-menu-container">
          <ul class="nav-menu">
            <li class="menu-active"><a href="#home">Home</a></li>
            <li><a href="#feature">Features</a></li>
            <li><a href="#price">Price</a></li>
            <li><a href="#testimonial">Testimonial</a></li>
            <li class="menu-has-children"><a href="">Pages</a>
              <ul>
                <li><a href="generic.html">Generic</a></li>
                <li><a href="elements.html">Elements</a></li>
              </ul>
            </li>
            <li><a class="ticker-btn" href="sign-in.php">Login</a></li>
          </ul>
        </nav><!-- #nav-menu-container -->
      </div>
    </div>



    <div class="container">

      <br>
      <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
          <center><h4 class="fancy">Sign In</h4>
          <hr class="mt-0">
          <?=$sign_in_alert?>
          <form action="" method="post">
            <fieldset class="form-group">
              <input name="email" value="<?=htmlspecialchars($_POST["email"])?>" placeholder="Email" type="text" class="form-control" autofocus>
            </fieldset>
            <fieldset class="form-group">
              <input name="password" placeholder="Password" type="password" class="form-control">
              <!-- <small class="form-text text-muted"><a href="/reset">Forgot your password?</a></small> -->
            </fieldset>
            <fieldset class="form-group">
              <input name="submit" type="submit" value="Sign In" class="btn btn-primary">
            </fieldset>
          </form>
          <br>
          <hr>
          <br>
          <!-- <h4 class="fancy">Don't have an account?</h4>
          <hr class="mt-0">
          <a href="sign-up.php" class="btn btn-primary" role="button">Sign Up</a></center> -->
        </div>

        <div class="col-sm-4"></div>
      </div>

      <hr>

    </div>

    <script src="//code.jquery.com/jquery-3.1.1.slim.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
  </body>
</html>
