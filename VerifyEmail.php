<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	//session_start();
	require_once('VerifyEmail.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Verify Email</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<?php
	$errors = 0;
	$token = "";
	if (isset($_POST['submit'])){
		
	
		$db_user = "jcardinal_I505";
		$db_pwd = "jpI@2021";
		$mysqli = new mysqli("localhost:3306",$db_user,$db_pwd,"db_jcardinal_I505");
					
		$email = $_POST['email'];
		$SQL = "select * from account where account_email='".$email."'";			
				
		$result = mysqli_query($mysqli, $SQL);
		$user = mysqli_fetch_assoc($result);
				
		if (is_null($user)) {
			header('location: forgotpassword.php?Wrong');
		}
		else {
			$email = $_POST['email'];
			$pass_token = $user['account_passtoken'];
			sendPasswordResetLink($email, $pass_token);			
		}		
	}
	
	function sendPasswordResetLink($userEmail, $pass_token){
		
			$body = '<!DOCTYPE html>
			<html lang="en">
			<head> 
				<meta charset="UTF-8">
				<title>Verify email </title>
			</head>
			<body>
				<div class="wrapper">
					<p>
						Hello, <br /><br />
						
						Please click on the link below to reset your password.
					</p>
					<a href="http://52.90.205.159/ITE505/jcardinal_I505/PHP/index.php?pass_token=' .$pass_token. '">
						Reset Password Link
					</a>	
				</div>
			</body>
			</html>';
						
			//include required files from phpmailer
			require('../phpmailer/includes/PHPMailer.php');
			require('../phpmailer/includes/SMTP.php');
			require('../phpmailer/includes/Exception.php');
			//create phpmailer object
			$mail = new PHPMailer;
			$mail->IsSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = "true";
			$mail->SMTPSecure = "ssl";
			$mail->Port = 465;
			$mail->Username = "noreply.canvasapi@gmail.com";
			$mail->Password = "iqKCLN08Cj";
			$mail->Subject = "Reset Password";
			$mail->setFrom("noreply.canvasapi@gmail.com");
			$mail->Body = $body;
			$mail->IsHTML(true);   
			$mail->addAddress($userEmail);
			$mail->Send();
			
			header('location: EmailSent.php');			
					
		}
		
		//if user clicks reset password button
		if (isset($_POST['reset_password'])) {
			$password = $_POST['password'];
			$password_md5 = md5($password);
			$pass_token = $_SESSION['account_passtoken'];
			
			$db_user = "jcardinal_I505";
			$db_pwd = "jpI@2021";
			$mysqli = new mysqli("localhost:3306",$db_user,$db_pwd,"db_jcardinal_I505");
			
			$sql_password = "update account set account_password='".$password_md5."' where account_passtoken='".$pass_token."'";
			$result_password = mysqli_query($mysqli, $sql_password);
			header('location: login.php?pass_reset');
			exit(0);
			
		}
		
		function resetPassword($pass_token){
			global $conn;
			$sql2 = "select * from account where account_passtoken='".$pass_token."' LIMIT 1";
			$result2 = mysqli_query($conn, $sql2);
			$user2 = mysqli_fetch_assoc($result2);
			$_SESSION['email'] = $user2['email'];
			header('location: reset_password.php');
			exit(0); 
		}
?>
</body>
</html>