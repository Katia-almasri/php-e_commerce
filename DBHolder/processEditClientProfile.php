<?php
		require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Company.php';
		require_once 'ClientManager.php';
		require_once 'auxFunctions.php';

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

		$editedUsername = htmlspecialchars($_POST['editedUsername']);
		$editedEmail = htmlspecialchars($_POST['editedEmail']);
		$editedAbout_you = htmlspecialchars($_POST['editedAbout_you']);
		$editedPassword = htmlspecialchars($_POST['editedPassword']);
		$errorFound = 'false';

		if(empty($editedUsername)|| empty($editedEmail) ||empty($editedPassword)){
			$errorFound = 'fill in  all require fields';
		}else if(!filter_var($editedEmail, FILTER_VALIDATE_EMAIL)){
				$errorFound= 'invalid email!';
		}else{
			

			$client = new ClientManager();
			$originalINFO = $client->selectQuery("SELECT * FROM client WHERE email = '$editedEmail' AND client_id<>'$client_id'");
			///////here////////////
			if($originalINFO!==NULL){
				$errorFound = 'there is laready account with this email!';
			}else{
				$data = $client->updateQuery("UPDATE client set
								username = '$editedUsername',
								email = '$editedEmail', 
								about_you = '$editedAbout_you', 
								password = '$editedPassword'
								WHERE client_id = '$client_id'
						");
							if($data!==false)
								$errorFound='you have just edited your '.$editedUsername.' profile<br>';
							else
								$errorFound = 'there were som errors!';

			}
			

		}
		$_SESSION['password'] = $editedPassword;
		$_SESSION['email'] = $editedEmail;
		echo $_SESSION['email'];
		echo $errorFound;

?>