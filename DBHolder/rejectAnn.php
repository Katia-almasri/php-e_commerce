<?php
	require_once 'AdminManager.php';
	/*session_start();
	if(isset($_SESSION['email']){
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
	}else{
		echo "You dont have permission to login thi page!";
		exit();
	}*/

	$ann_ord_id = htmlspecialchars($_POST['ann_ord_id']);
	$admin = new AdminManager();
	$result = $admin->updateQuery("UPDATE announcement_orders
				SET
				is_processed = 1,
				is_accepted = 0 
				WHERE a_o_id = '$ann_ord_id';");
		
		if($result!==false)
			echo "dont know";
	
