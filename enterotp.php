<?php
session_start();
if($_SESSION["email"]){
    $email=$_SESSION["email"];
}
else{
    echo '<script>alert("Error!");</script>';
    echo '<script>window.location.href="forgotpassword.php";</script>';
}
include "config.php";

if(isset($_POST['submit'])){

    $otp=$_POST['otp'];
    $s = "SELECT `token` FROM `tb_reg` WHERE `email`='$email'";
    $res = mysqli_query($link, $s);
    $nu=mysqli_fetch_array($res);
    if ($nu['token'] == $otp)
	 {
        echo '<script>alert("OTP Verified");</script>';
        echo '<script>window.location.href="updatepassword.php";</script>';
    }
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Smartmart</title>
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
		    	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
					<h3>Verify OTP!!!</h3>
					<div class="form-wrapper">
						<input type="text" name="otp" placeholder="Enter otp" class="form-control"  required>
						<i class="zmdi zmdi-account"></i>
               			 <span class="invalid-feedback"></span>
					</div>
					<button type="submit" name="submit">Send OTP
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
				</form>
			</div>
		</div>
	</body>
</html>

