<?php
	session_start();
	require_once 'ValidatePasswordReset.php'
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
</head>

<body>
<?php
	function resetPassword($pass_token){
			global $conn;
			$sql2 = "select * from account where pass_token='".$pass_token."' LIMIT 1";
			$result2 = mysqli_query($conn, $sql2);
			$user2 = mysqli_fetch_assoc($result2);
			$_SESSION['email'] = $user2['email'];
			header('location: reset_password.php');
			exit(0); 
		}

?>
</body>

</html>