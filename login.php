<?php
    require('config.php');
	session_start();
   
    if (isset($_POST['submit']))
    {
        $email = stripslashes($_REQUEST['email']);  
        $email = mysqli_real_escape_string($link, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($link, $password);
        $query    = "SELECT * FROM `tb_reg` WHERE email='$email' AND password='$password'";
        $result = mysqli_query($link, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
			$query = "SELECT username FROM `tb_reg` WHERE email='$email'";
			$result = mysqli_query($link, $query);
			$rows = mysqli_fetch_assoc($result);
			$username=$rows['username'];
			//session_start();
			$_SESSION['username']=$username;
            header("Location:main/index.php");
        }
	
		
         else
          {
            echo "<div class='form'>
                  <h3>Incorrect email/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    }
    else
    {
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Smartmart-Login now!!!</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="wrapper" style="background-image: url('images/bg-registration-form-1.jpg');">
			<div class="inner">
				<div class="image-holder">
					<img src="images/registration-form-1.jpg" alt="">
				</div>
                <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
		    	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
					<h3>Login Now!!!</h3>
					<div class="form-wrapper">
						<input type="text" name="email" placeholder="email" class="form-control"  required>
						<i class="zmdi zmdi-account"></i>
               			 <span class="invalid-feedback"></span>
					</div>
					<div class="form-wrapper">
						<input type="password" placeholder="Password" name="password" class="form-control " required>
						<i class="zmdi zmdi-lock"></i>
						<span class="invalid-feedback"></span>
					</div>
					<button type="submit" name="submit">Login
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
					<center><a href="forgotpassword.php">Forgot Password</a></center>
                    <p>If not a registered user, Please<a href="registration.php"> Register Now</a></p>
				</form>
			</div>
		</div>
		<?php
	}
	?>
	</body>
</html>

