<?php
    require('config.php');
   
    if (isset($_POST['submit']))
    {
        
        $username = stripslashes($_REQUEST['username']);  
        $username = mysqli_real_escape_string($link, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($link, $password);
        $query    = "SELECT * FROM `tbl_admin` WHERE admin_username='$username' AND password='$password'";
        $result = mysqli_query($link, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['admin_username'] == '$admin_username';
            header("Location:admin/html/index.php");
        }
	else
          {
            echo "<div class='form'>
                  <h3>Incorrect username/password.</h3><br/>
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
		<title>Smartmart- Admin Login now!!!</title>
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
					<h3>Admin Login Now!!!</h3>
					<div class="form-wrapper">
						<input type="text" name="username" placeholder="Username" class="form-control"  required>
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
				</form>
			</div>
		</div>
		<?php
	}
	?>
	</body>
</html>

