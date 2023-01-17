<?php
		require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Company.php';
		require_once 'CompanyManager.php';
		require_once 'auxFunctions.php';
		$email = '';
		$psd = '';
		$com_id = '';

session_start();
	if(isset($_SESSION['com_id']))
		{
			
			$email = $_SESSION['email'];
			$psd = $_SESSION['psd'];
			$com_id = $_SESSION['com_id'];			
		
		}else{
			echo 'you dont have permission to login this page';
			echo '<a href="login.php">LOGIN </a>';
				
		}

		$editedCom_name = htmlspecialchars($_POST['editedCom_name']);
		$editedBranch = htmlspecialchars($_POST['editedBranch']);
		$editedDate_of_launch = htmlspecialchars($_POST['editedDate_of_launch']);
		$editedOwner = htmlspecialchars($_POST['editedOwner']);
		$editedEmail = htmlspecialchars($_POST['editedEmail']);
		$editedAbout_us = htmlspecialchars($_POST['editedAbout_us']);
		$editedPsd = htmlspecialchars($_POST['editedPsd']);
		$errorFound = 'false';

		if(empty($editedCom_name)|| empty($editedOwner) || empty($editedEmail) ||empty($editedAbout_us)){
			$errorFound = 'true';
		}else if(!filter_var($editedEmail, FILTER_VALIDATE_EMAIL)){
				$errorFound= 'invalid email!';
		}else{
			if(!empty($editedDate_of_launch)){
				if(checkDateInput($editedDate_of_launch)===false){
					$errorFound = 'true';
				}
			}

			$company = new CompanyManager();
			$editedINFO = $company->selectQuery("SELECT * FROM company WHERE email = '$editedEmail' AND  com_id <>'$com_id'");
			if($editedINFO!==NULL)
				$errorFound = 'there is alredy account with this email!';
			else{
				$data = $company->updateQuery("UPDATE company SET
					name = '$editedCom_name', 
					branch = '$editedBranch', 
					date_launch = '$editedDate_of_launch', 
					owner = '$editedOwner', 
				    email = '$editedEmail', 
				    about_us = '$editedAbout_us', 
				    password = '$editedPsd'
				    WHERE  com_id ='$com_id'
					");
				if($data!==false)
					$errorFound = 'you have just edited your '.$editedCom_name.' profile<br>';
				else
					$errorFound = 'there were som errors!';
			}

		}
		$_SESSION['psd'] = $editedPsd;
		$_SESSION['email'] = $editedEmail;
		echo $_SESSION['email'];
		echo $errorFound;

?>