<?php 
	session_start();
	require_once 'VerifyEmail.php';
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 2</title>
</head>

<body>
<?php
	if (isset($_GET['pass_token'])){
		$pass_token = $_GET['pass_token'];
		$_SESSION['account_passtoken'] = $pass_token;
		resetPassword($pass_token);
	}
?>
</body>

</html>