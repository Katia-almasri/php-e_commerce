<?php

	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	require_once 'CompanyManager.php';

	$email = '';
	$psd = '';
	$com_id = 0;
	session_start();
	if(isset($_SESSION['com_id']))
		{
			
			$email = $_SESSION['email'];
			$psd = $_SESSION['psd'];
			$com_id = $_SESSION['com_id'];
			echo $com_id;
						
		
		}else{
			echo 'you dont have permission to login this page';
			echo '<a href="login.php">LOGIN </a>';
				
		}

		$editedName = '';
		$editedBranch = '';
		$editedEmail = '';
		$editedOwner = '';
		$editedPassword = '';
		$editedAbout_us = '';
		$editedLocation = '';

		if(isset($_POST['name'])){
			$editedName = htmlspecialchars($_POST['name']);
			$editedEmail = htmlspecialchars($_POST['email']);
			$editedLocation = htmlspecialchars($_POST['com_location']);
			$editedOwner = htmlspecialchars($_POST['owner']);
			$editedBranch = htmlspecialchars($_POST['branch']);
			$editedAbout_us = htmlspecialchars($_POST['about_us']);
			$editedPassword = htmlspecialchars($_POST['password']);
	
		}

		$errorFound = 'false';
		if(empty($editedName)|| empty($editedOwner) || empty($editedEmail) ||empty($editedAbout_us)){
			$errorFound = 'true';
		}else if(!filter_var($editedEmail, FILTER_VALIDATE_EMAIL)){
				$errorFound= 'invalid email!';
		}else{
			
			$company = new CompanyManager();
			$editedINFO = $company->selectQuery("SELECT * FROM company WHERE email = '$email' AND  com_id <>'$com_id'");
			if($editedINFO!==NULL)
				$errorFound = 'there is alredy account with this email!';
			else{
				$data = $company->updateQuery("UPDATE company SET
					name = '$editedName', 
					branch = '$editedBranch', 
					owner = '$editedOwner', 
				    email = '$editedEmail', 
				    about_us = '$editedAbout_us', 
				    password = '$editedPassword', 
				    location = '$editedLocation'
				    WHERE  com_id ='$com_id'
					");
				if($data!==false)
					$errorFound = 'you have just edited your '.$editedName.' profile<br>';
				else
					$errorFound = 'there were som errors!';
			}

		}
		$_SESSION['psd'] = $editedPassword;
		$_SESSION['email'] = $editedEmail;
		echo $_SESSION['email'];
		echo $errorFound;


?>

