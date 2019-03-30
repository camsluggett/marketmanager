<?php
require_once './config/config.php';

if ($_POST["submit"])
{
  $name = $_POST["name"];
	$email = $_POST["email"];
	$password = $_POST["password"];

	if (empty($email) || empty($password))
  {
		$alert = '<p class="text-danger">All fields must be filled out.</p>';
	}
  else
  {
    $sql = $db->prepare("SELECT email FROM users WHERE email=?");
    $sql->execute([$email]);

    if ($sql->rowCount() != 0)
    {
      $alert = '<p class="text-danger">Email is already registered.</p>';
    }
    else
    {
      $password = password_hash($password, PASSWORD_DEFAULT);

      $sql = $db->prepare("INSERT INTO users (email, password, name) VALUES (?, ?, ?)");
      $sql->execute([$email, $password, $name]);

      $_SESSION["authenticated_user"] = $db->lastInsertId();

      //$_SESSION["authenticated_user"] = $email;

      header("location: markets.php");
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
  <link rel="shortcut icon" href="img/fav.png">
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
        <a href="index.html"><img src="img/logo.png" width: "50" height: "50" alt="" title="" /></a>
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
        <div class="col-sm-2">

				</div>
        <div class="col-sm-4">
          <h4 class="fancy">Sign Up</h4>
    			<hr class="mt-0">
          <?=$alert?>
          <form action="" method="post">
            <div class="form-group">
              <input name="name" value="<?=htmlspecialchars($_POST["name"])?>" placeholder="Name" type="text" class="form-control">
            </div>
            <div class="form-group">
              <input name="email" value="<?=htmlspecialchars($_POST["email"])?>" placeholder="Email" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
              <input name="password" placeholder="Password" type="password" class="form-control">
            </div>


    				<div class="form-group">
    					<div class="g-recaptcha" data-sitekey="6Lfy0h0UAAAAAPpeZi7TeJk1NFnZGM29rLonILbr"></div>
    				</div>
    				<div class="form-group">
    			    <label class="form-check-label">
    			      <input type="checkbox" class="form-check-input">
    			      I agree to the <a href="terms">Terms of Use</a>.
    			    </label>
    			  </div>
            <div class="form-group">
              <input name="submit" type="submit" value="Sign Up" class="btn btn-primary">
            </div>
          </form>
					<br><br>


        </div>


      </div>

      <hr> <center>

		</center>

    </div>

    <script src="//code.jquery.com/jquery-3.1.1.slim.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <script src="//www.google.com/recaptcha/api.js"></script>
  </body>
</html>
