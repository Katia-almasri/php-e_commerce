<?php


	require_once 'AdminManager.php';
	require_once 'ProductManager.php';

	/*session_start();
	if(isset($_SESSION['email']){
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
	}else{
		echo "You dont have permission to login thi page!";
		exit();
	}*/

	$not_id = htmlspecialchars($_GET['not_id']);
	$admin = new AdminManager();
	$result = $admin->updateQuery("UPDATE notification
				SET
				is_procecced = 1,
				is_accepted = 0 
				WHERE not_id = '$not_id';");
		
		if($result!==false)
			echo "rejected successfully";
		//write cause of refusing??
	
