<?php
    include 'config.php';
	session_start();
    if($_SESSION['email']){
        $email=$_SESSION['email'];
    }
    if (isset($_POST['submit']))
    {   
		$email=$_SESSION['email'];
        $password = $_POST['password'];
        $confirm_password =$_POST['confirm_password'];
        $sql="UPDATE `tb_reg` SET `password`='$password', `confirm_password`='$confirm_password' WHERE `email`='$email'";
        $result = mysqli_query($link,$sql);
        // $rows = mysqli_fetch_array($result);
        if ($link->query($sql) == TRUE) {
            echo '<script>alert("Password Changed");</script>';
            echo '<script>window.location.href="login.php";</script>';
        }
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Smartmart-Online Shoping Website</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>

		<div class="wrapper" style="background-image: url('images/bg-registration-form-1.jpg');">
			<div class="inner">
				<div class="image-holder">
					<img src="images/registration-form-1.jpg" alt="">
				</div>
				<form action="" method="POST">
					<h3>Change Password</h3>
					<div class="form-wrapper">
						<input class="form-control" type="password" name="password" class="box" placeholder="Enter your new password here" required id="pass">
						<i class="zmdi zmdi-lock"></i>
					</div>
					<div class="form-wrapper">
						<input class="form-control" type="password" name="confirm_password" class="box" placeholder="Re-enter your password here" required id="cpass">
						<i class="zmdi zmdi-lock"></i>
					</div>
					<button type="submit" name="submit">Change
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
				</form>
			</div>
		</div>	
        <!-- <script type="text/javascript">
    function ValidateEmail() {
        var email = document.getElementById("mail").value;
        var lblError = document.getElementById("lblError");
        lblError.innerHTML = "";
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (!expr.test(email)) {
            lblError.innerHTML = "Invalid email address.";
        }
    }
</script> -->
	</body>
</html>