<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT uid FROM tb_reg WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email id.";     
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Validate phonenumber
    if(empty(trim($_POST["phonenumber"]))){
        $phonenumber_err = "Please enter a phone number.";     
    } elseif(strlen(trim($_POST["phonenumber"])) < 10){
        $phonenumber_err = "phone number must have atleast 10 values.";
    } else{
        $phonenumber = trim($_POST["phonenumber"]);

    }
    echo "<script> alert($phonenumber)</script>";

    // Validate usertype
    if(empty($_POST["usertype"])){
        $usertype_err = "Please choose a usertype.";     
    } else{
        $usertype = trim($_POST["usertype"]);
    }
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($email_err) && empty($phonenumber_err) && empty($usertype_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO `tb_reg`(`username`, `email`, `phonenumber`, `password`, `confirm_password`,
        `usertype`, `timestamp`) VALUES  (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                //header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Smartmart-Register now!!!</title>
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
				<form action="regsubmit.php" method="post">

			<h3>Registration Now!!!</h3>
			<div class="form-wrapper">
			<input class="form-control" type="text" name="fname" class="box" placeholder="Username" id="fname" placeholder="Username" required onkeyup="return ValidateName();"> 
             <i class="zmdi zmdi-account"></i>						
					</div><span id="idname" name="idname"></span>

					<div class="form-wrapper">
						<input class="form-control" type="email" name="mail" class="box" placeholder="enter your email" id="mail" required  onkeyup="return ValidateEmail();" >
						<i class="zmdi zmdi-email"></i>
					</div><span id="idmail" name="idmail"></span>

					<div class="form-wrapper">
						<input class="form-control" type="text"  name="phonenumber"  maxlength="10" placeholder="Enter your phone number" id="phonenumber" required  onkeyup="return ValidatePhone();" >
						<i class="zmdi zmdi-phone"></i>
					</div><span id="idphone" name="idphone"></span>

					<div class="form-wrapper">
						<select name="usertype" id="usertype" class="form-control">
							<option value="" disabled selected>User Type</option>
							<option value="vendor">Vendor</option>
							<option value="customer">Customer</option>
						</select><i class="zmdi zmdi-caret-down" style="font-size: 17px"></i>
					</div>

					<div class="form-wrapper">
						<input class="form-control" type="password" name="password" id="password" class="box" placeholder="Enter your new password here" required onkeyup="return ValidatePassword();">
						<i class="zmdi zmdi-lock"></i>   </div> <span id="idpassword" name="idpassword"></span>

					<div class="form-wrapper">
						<input class="form-control" type="password" name="confirm_password" id="confirm_password" class="box" placeholder="Re-enter your password here" required onkeyup="return ValidateCpass();" >
						<i class="zmdi zmdi-lock"></i>   </div><span id="idcpass" name="idcpass"></span>

					<button type="submit" name="submit">Register
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
                    <p>Already have an account? <a href="login.php">Login here</a>.</p>
        
				</form>
			</div>
		</div>	
        
<script type="text/javascript">
function ValidateName() 
                            {
                              
                            var val = document.getElementById('fname').value;
                            if (!val.match(/^[A-Z].*$/)) 
                            {
                              document.getElementById('idname').innerHTML="Start with a Capital letter & Only alphabets are allowed";
                              document.getElementById('fname').value = val;
                              document.getElementById('fname').style.color = "red";
                                      return false;
                                     flag=1;
                            }
                            if(val.length<3||val.length>30){
                              document.getElementById('idname').innerHTML="Between 3 to 10 characters";
                              document.getElementById('fname').value = val;
                              document.getElementById('idname').style.color = "red";
                                      return false;          
                            }
                            else{
                              document.getElementById('idname').innerHTML=" ";
                              document.getElementById('fname').style.color = "green";
                             return true;
                            }
                          }
                       
function ValidateEmail()
                            {
                              var email=document.getElementById('mail').value;  
                              var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                              if(mail.length<3||mail.length>30){
                                document.getElementById('idmail').innerHTML="Invalid Email";
                                    document.getElementById('mail').value = email;
                                    document.getElementById('mail').style.color = "red";
                                //    alert("err");
                                      return false;
                              }
                              if(!email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)){  
                                document.getElementById('idmail').innerHTML="Please enter a valid Email";  
                                document.getElementById('mail').value = email;
                                document.getElementById('mail').style.color = "red";
                              return false;  
                              }
                              else{
                              document.getElementById('idmail').innerHTML=" ";
                              document.getElementById('mail').style.color = "green";
                             return true;                              
                            }
                          }

function ValidatePhone()
                        {
                        var phonenumber=document.getElementById('phonenumber').value; 
                        var phoneno = /^[0]?[7-9]\d{9}$/; 
                        if(phonenumber.match(phoneno) )
                        {
                                document.getElementById('idphone').innerHTML=" ";
                                document.getElementById('phonenumber').style.color = "green";
                              return true;
                        }
                        if(phonenumber.lenght>10 )
                        {
                                document.getElementById('idphone').innerHTML="Invalid Phone Number";
                                document.getElementById('phonenumber').style.color = "red";
                              return true;
                        }
                        else {
                                document.getElementById('idphone').innerHTML="Invalid Phone number";
                                    document.getElementById('phonenumber').value = phonenumber;
                                    document.getElementById('phonenumber').style.color = "red";
                                return false;
                              }
                            }
                            
function ValidatePassword()
                             {
                              var password=document.getElementById('password').value;
                               var patt="/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/";
                              if (password.length<8)
                               if(!password.match(/[a-z]/g)){
                                document.getElementById('password').value = password;
                                document.getElementById('idpassword').innerHTML="Enter a strong password eg:Aa#23gh56";
                                  document.getElementById('password').style.color="red"
                                  return false;
                                }
                                if(!password.match(/[A-Z]/g)){
                                  document.getElementById('password').value = password;
                                  document.getElementById('idpassword').innerHTML="Include minimum one capital letter";
                                 document.getElementById('password').style.color="red"

                                     return false;
                                }
                                if(!password.match(/[0-9]/g)){
                                  document.getElementById('password').value = password;
                                  document.getElementById('idpassword').innerHTML="Include 1 digit";
                                document.getElementById('password').style.color="red"

                                return false;
                                 }
                              if(!password.match(/[^a-zA-Z\d]/g)){
                                document.getElementById('password').value = password;
                                document.getElementById('idpassword').innerHTML="Include 1 special character";
                              document.getElementById('password').style.color="red"
                              return false;
                                 }
                            if(password.length < 8){
                              document.getElementById('password').value = password;
                              document.getElementById('idpassword').innerHTML="Minimum 8 characters";
                              document.getElementById('password').style.color="red"
                              return false;
                            }
                              else{
                               
                                document.getElementById('idpassword').innerHTML="";
                                document.getElementById('password').style.color = "green";
                              }                        
                          }

 function ValidateCpass()
                             {
                              var pass1=document.getElementById('password').value;
                              var pass2=document.getElementById('confirm_password').value;
                               if (pass1!=pass2)
                                        {
                                document.getElementById('idcpass').innerHTML="Password doesn't match ";  
                                document.getElementById('confirm_password').value = pass2;
                                document.getElementById('confirm_password').style.color = "red";
                              return false;  
                              }
                           
                              else{
                              document.getElementById('idcpass').innerHTML=" ";
                              document.getElementById('confirm_password').style.color = "green";
                            return true;
                              
                            }
                          }
                                
                            function Val()
                            {
                              if(ValidateName()===false || ValidatePhone()===false || ValidateEmail()===false || ValidatePassword()===false || ValidateCpass()===flase)
                              {
                                return false;
                              }
                            }
    
</script>
</body>
</html>