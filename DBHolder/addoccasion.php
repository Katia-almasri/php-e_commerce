<?php
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Admin.php';
	require_once 'CompanyManager.php';
	require_once 'ClientManager.php';
	require_once 'AdminManager.php';

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

	$name = htmlspecialchars($_POST['name']);
	echo $name;
	if(!empty($name)){
		$admin = new AdminManager();
		$result = $admin->insertQuery("INSERT INTO ocaasion (occasion_name) values('$name')");
		if($result!==false)
			echo "YES";
	}else{
		echo "NO";
	}


?>