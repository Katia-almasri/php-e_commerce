<?php

	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Admin.php';
	require_once 'auxFunctions.php';
	require_once 'DBManager.php';

	$outputString='';
	$shipment_id  = 0;
	$email = htmlspecialchars($_POST['email']);
	$shipment_name = htmlspecialchars($_POST['shipment_name']);
	if(!empty($email) && !empty($shipment_name)){
			
			//check validation..
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$outputString.= 'invalid email!';
			
			}else{
				$shipment = new DBManager();
				$data = $shipment->selectQuery("SELECT * FROM shipment WHERE email = '$email'");
				if($data!==NULL)
				{	
					
					$shipment_id = $data[0]['shipment_id'];
				}else{
					$outputString = 'There is no account with this inputs!!';
				}
			}

	}

	else{
		$outputString = 'fill in all fields!!!';
	}
		session_start();
		$_SESSION['shipment_id'] = $shipment_id;
		$_SESSION['shipment_name'] = $shipment_name;
		$_SESSION['email'] = $email;
			
		echo $outputString;
?>
