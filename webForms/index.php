<?php session_start(); /* Starts the session */

	/* Check Login form submitted */
	if(isset($_POST['Submit'])){
		/* Define username and associated password array */
		$logins = array('admin' => 'password');

		/* Check and assign submitted Username and Password to new variable */
		$Username = isset($_POST['Username']) ? $_POST['Username'] : '';
		$Password = isset($_POST['Password']) ? $_POST['Password'] : '';

		/* Check Username and Password existence in defined array */
		if (isset($logins[$Username]) && $logins[$Username] == $Password){
			/* Success: Set session variables and redirect to Protected page  */
			$_SESSION['UserData']['Username']=$logins[$Username];
			header("location:entries.php");
			exit;
		} else {
			/*Unsuccessful attempt: Set error message */
			$msg='<div class="alert alert-danger" role="alert">
              Invalid Login Details! Try Again
          </div>';
		}
	}
?>

<!------------------------------------------------------------------------------->



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="icon" href="http://www.elpasotruefood.com/wp-content/uploads/2017/12/TRUE-7-6-e1514515491312.jpg">
  </head>
  <body>


<div class="container">
  <div class="card card-container">
    <!--INvalid credentials message-->
      <?php if(isset($msg)){?>
      <?php echo $msg;?>
      <?php } ?>

    <!--INvalid credentials message-->

      <img id="profile-img" class="profile-img-card" src="http://www.elpasotruefood.com/wp-content/uploads/2017/12/TRUE-7-6-e1514515491312.jpg" />

      <form class="form-signin" action="" method="post" name="Login_Form">
          <br>
          <input name="Username" type="text" id="inputEmail" class="form-control Input" placeholder="Username" required autofocus>
          <input name="Password" type="password" id="inputPassword" class="form-control Input" placeholder="Password" required>

          <button name="Submit" class="btn btn-lg btn-warning btn-block btn-signin" type="submit">Sign in</button>
      </form><!-- /form -->

      <a href="#" class="forgot-password">
          Forgot the password?
      </a>

  </div><!-- /card-container -->
</div><!-- /container -->

  </body>
</html>
