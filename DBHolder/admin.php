<?php

	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Admin.php';
	require_once 'auxFunctions.php';
	require_once 'AdminManager.php';
	$outputString='';
	$admin_id  = 0;
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);
	if(!empty($email) && !empty($password)){
			
			//check validation..
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$outputString.= 'invalid email!';
			
			}else{
				$admin = new AdminManager();
				$data = $admin->selectQuery("SELECT * FROM admin WHERE email = '$email' AND password = '$password'");
				if($data!==NULL)
				{	
					
					$admin_id = $data[0]['ad_id'];
				}else{
					$outputString = 'There is no account with this inputs!!';
				}
			}

	}

	else{
		$outputString = 'fill in all fields!!!';
	}
		session_start();
		$_SESSION['admin_id'] = $admin_id;
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $password;
		
		echo $outputString;
?>
