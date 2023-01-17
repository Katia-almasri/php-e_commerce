<?php

	require_once 'AdminManager.php';
	require_once 'adminstatistics.php';

	session_start();
	if(isset($_SESSION['email']))
	{
		
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
		
	}else{
		echo 'you dont have permission to login this page';
		echo '<a href="login.php">LOGIN </a>';
		exit();
			
	}



?>

<!DOCTYPE html>
<html>
<head>
	<title>admin statistics</title>
</head>
<body>
	<button id="">
	</button>
</body>
</html>