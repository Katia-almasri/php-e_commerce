
<?php
		require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Company.php';
		require_once 'ClientManager.php';
		require_once 'auxFunctions.php';

		session_start();
			if(isset($_SESSION['email']))
		{
			
			$email = $_SESSION['email'];
			$password = $_SESSION['password'];
			
			
		
		}else{
			echo 'you dont have permission to login this page';
			echo '<a href="login.php">LOGIN </a>';
				
		}

		$client = new ClientManager();
		
	if(isset($_FILES['uploadImage_pro']['name'])){
			
			$filename = $_FILES['uploadImage_pro']['name'];
			
			$location = "proclient/".$filename;
			preg_replace( "/\r|\n/", "", $location);
			$imageFileType = pathinfo($location, PATHINFO_EXTENSION);
			$imageFileType = strtolower($imageFileType);
			$valid_extension = array('jpg', 'jpeg', 'png');
			$response = 0;
			if(in_array(strtolower($imageFileType), $valid_extension)){
				if(move_uploaded_file($_FILES['uploadImage_pro']['tmp_name'], $location)){
					$response = $location;
					
					}
			}
			echo $location;
			exit();
		}
		echo 0;

		
	?>