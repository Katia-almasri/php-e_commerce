<?php

	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	require_once 'ClientManager.php';

	$email = '';
	$password = '';
	$client_id = 0;
	session_start();
	if(isset($_SESSION['client_id']))
		{
			
			$email = $_SESSION['email'];
			$password = $_SESSION['password'];
			$client_id = $_SESSION['client_id'];
						
		
		}else{
			echo 'you dont have permission to login this page';
			echo '<a href="login.php">LOGIN </a>';
				
		}

		$editedUsername = '';
		$editedEmail = '';
		$editedPassword = '';
		$editedAbout_you = '';
		$editedLocation = '';
		$editedNu = '';
		$editedWork = '';

		if(isset($_POST['username'])){
			$editedUsername = htmlspecialchars($_POST['username']);
			$editedEmail = htmlspecialchars($_POST['email']);
			$editedLocation = htmlspecialchars($_POST['client_location']);
			$editedAbout_you = htmlspecialchars($_POST['about_you']);
			$editedPassword = htmlspecialchars($_POST['password']);
			$editedNu = htmlspecialchars($_POST['nu']);
			$editedWork = htmlspecialchars($_POST['work']);
		}

		$errorFound = 'false';
		if(empty($editedUsername) || empty($editedEmail)|| empty($editedPassword)){
			$errorFound = 'true';
		}else if(!filter_var($editedEmail, FILTER_VALIDATE_EMAIL)){
				$errorFound= 'invalid email!';
		}else{
			
			$client = new ClientManager();
			$editedINFO = $client->selectQuery("SELECT client.client_id, company.com_id FROM client, company WHERE (client.email='$editedEmail' OR company.email = '$editedEmail') AND client_id<>'$client_id'");
			if($editedINFO!==NULL){
				$errorFound = 'there is alredy account with this email!';
				$editedEmail = $email;
			}
			else{
				$data = $client->updateQuery("UPDATE client SET
					username = '$editedUsername', 
				    email = '$editedEmail', 
				    about_you = '$editedAbout_you', 
				    password = '$editedPassword', 
				    location = '$editedLocation',
				    work = '$editedWork',
				    nu = '$editedNu'
				    WHERE  client_id ='$client_id';
					");
				if($data!==false)
					$errorFound = 'you have just edited your '.$editedUsername.' profile<br>';
				else
					$errorFound = 'there were som errors!';
			}

		}
		$_SESSION['password'] = $editedPassword;
		$_SESSION['email'] = $editedEmail;
		echo $errorFound;


?>

