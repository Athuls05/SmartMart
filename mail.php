<?php
include "config.php";
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

if(isset($_POST['submit'])){

    $useremail=$_POST['email'];
    $s = "SELECT * FROM tb_reg WHERE email='$useremail'";
    $res = mysqli_query($link, $s);
    $nu=mysqli_num_rows($res);
  

    if($nu==0)
    {
        $noemail="Invalid Email";
        //header('location:forgotpassword.php');
    }
    else{
      $name="select username as c from tb_reg where email='$useremail'";
      $namef=mysqli_query($link,$name);
      $row = mysqli_fetch_array($namef);
        $nam = $row['c'];
        $token=rand(100, 550000);
        $que="UPDATE `tb_reg` SET `token` = '$token' WHERE `email` = '$useremail'";
        $res2=mysqli_query($link,$que);


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'athuls2023a@mca.ajce.in';                     //SMTP username
    $mail->Password   = 'athulsmca2023';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('athuls2023a@mca.ajce.in');
    $mail->addAddress($useremail);     //Add a recipient
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the OTP <h3>'.$token.'<h3><b>copy this</b>';
    $mail->send();
    echo 'Message has been sent';
    header("location:enterotp.php");
    
} 
catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
}