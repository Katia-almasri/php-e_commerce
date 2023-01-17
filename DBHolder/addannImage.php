
<?php
		require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Company.php';
		require_once 'CompanyManager.php';
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

		$company = new CompanyManager();
		
	if(isset($_FILES['uploadImage']['name'])){
			
			$filename = $_FILES['uploadImage']['name'];
			
			$location = "annImage/".$filename;
			preg_replace( "/\r|\n/", "", $location);
			$imageFileType = pathinfo($location, PATHINFO_EXTENSION);
			$imageFileType = strtolower($imageFileType);
			$valid_extension = array('jpg', 'jpeg', 'png');
			$response = 0;
			if(in_array(strtolower($imageFileType), $valid_extension)){
				if(move_uploaded_file($_FILES['uploadImage']['tmp_name'], $location)){
					$response = $location;
					
					}
			}
			$imageSize = getimagesize($location);
			if($imageSize[0]!==325 || $imageSize[1]!==1920){
				echo 'the image should be(1920 X 325)';
				exit();
			}
			echo $location;
			exit();
		}
		echo 0;

		
	?>