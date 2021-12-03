<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
	
	
if ( isset( $_POST[ 'reset-request-submit' ] ) ) {

  $selector = bin2hex( random_bytes( 8 ) );
  $token = random_bytes( 32 );


  $url = "http://localhost/Php/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex( $token );


  $expires = date( "U" ) + 1800;


  require 'dbh.inc.php';


  $userEmail = $_POST[ "email" ];


  $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
  $stmt = mysqli_stmt_init( $conn );
  if ( !mysqli_stmt_prepare( $stmt, $sql ) ) {
    echo "There was an error!";
    exit();
  } else {
    mysqli_stmt_bind_param( $stmt, "s", $userEmail );
    mysqli_stmt_execute( $stmt );
  }

  $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?)";
  $stmt = mysqli_stmt_init( $conn );
  if ( !mysqli_stmt_prepare( $stmt, $sql ) ) {
    echo "There was an error!";
    exit();
  } else {

    $hashedToken = password_hash( $token, PASSWORD_DEFAULT );
    mysqli_stmt_bind_param( $stmt, "ssss", $userEmail, $selector, $hashedToken, $expires );
    mysqli_stmt_execute( $stmt );
  }


  mysqli_stmt_close( $stmt );
  mysqli_close( $conn );

$receiver = ($userEmail);
$subject = "Password Reset Request";
$body =  $body ='We recieved a password reset request. The link to reset your password is below. 
If you did not make this request, you can ignore this email
Here is your password reset link: 
"' . $url . '"' . $url . '"';
$sender = "From:simplescheduling2021@gmail.com";



		require('C:\xampp\htdocs\Php\includes\includes\PHPMailer\src\PHPMailer.php');
			require('C:\xampp\htdocs\Php\includes\includes\PHPMailer\src\SMTP.php');
			require('C:\xampp\htdocs\Php\includes\includes\PHPMailer\src\Exception.php');

  $mail = new PHPMailer;
			$mail->IsSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = "true";
			$mail->SMTPSecure = "ssl";
			$mail->Port = 587;
			$mail->Username = "simplescheduling2021@gmail.com";
			$mail->Password = "Cool4455!";
			$mail->Subject = "Reset Password";
			$mail->setFrom("simplescheduling2021@gmail.com");
			$mail->Body = $body;
			$mail->IsHTML(true);   
			$mail->addAddress($userEmail);
			$mail->Send();
				
	
	
if(mail($receiver, $subject, $body, $sender)){
  header( "Location: ../reset-password.php?reset=success" );
} else {
  header( "Location: ../signup.php" );
	
  exit();
}}