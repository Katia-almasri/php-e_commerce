
<?php
		require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Company.php';
		require_once 'CompanyManager.php';
		require_once 'auxFunctions.php';

		session_start();
			if(isset($_SESSION['email']))
		{
			
			$email = $_SESSION['email'];
			$psd = $_SESSION['psd'];
			
			
		
		}else{
			echo 'you dont have permission to login this page';
			echo '<a href="login.php">LOGIN </a>';
				
		}


	if(isset($_FILES['uploadImage']['name'])){
			
			$filename = $_FILES['uploadImage']['name'];
			$location ='uploads/'.$filename;
			$location = str_replace(' ', '', $location);
			$imageFileType = pathinfo($location, PATHINFO_EXTENSION);
			$imageFileType = strtolower($imageFileType);
			$valid_extension = array('jpg', 'jpeg', 'png');
			$response = 0;
			if(in_array(strtolower($imageFileType), $valid_extension)){
				if(move_uploaded_file($_FILES['uploadImage']['tmp_name'], $location)){
					$response = $location;
					$Company = new CompanyManager();
					$updatedImage = $Company->updateQuery("UPDATE company SET 
							image='$location'
							WHERE email='$email';
						");
				}
			}
			echo $location;
			exit();
		}
		echo 0;

		
	?>