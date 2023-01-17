<?php
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
		session_start();
	if(isset($_SESSION['username']))
	{	
		$username = $_SESSION['username'];
		$psd = $_SESSION['psd'];
	}
	else{
		echo 'you dont have permission to add product <br> you dont have account';
		//redireting to HOME
	}
	
		$name = htmlspecialchars($_POST['name']);
		$amount = htmlspecialchars($_POST['amount']);
		$pro_id = htmlspecialchars($_POST['pro_id']);
		$com_id = htmlspecialchars($_POST['com_id']);
		
		
		$product = new ProductManager();
		//recieve the original amount
		$data = $product->selectQuery("SELECT amount FROM procomp WHERE comp_id='$com_id' AND pro_id='$pro_id';", "procomp");
		if($data !==NULL){
			$originalAmount = $data[0]['amount'];
			$newAmount = $originalAmount+$amount;
			// return the new amount to db
			$data = $product->updateQuery("UPDATE procomp SET 
				amount = '$newAmount'
				WHERE comp_id='$com_id' AND pro_id='$pro_id';
				", "procomp");
				if($data===true){
				
					echo 'done..';
				}
		}
			
?>