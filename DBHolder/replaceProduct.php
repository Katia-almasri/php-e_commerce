<?php
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	session_start();
	if(isset($_SESSION['email']))
	{	
		$email = $_SESSION['email'];
		$psd = $_SESSION['psd'];
	}
	else{
		echo 'you dont have permission to add product <br> you dont have account';
		//redireting to HOME
	}
	

		$product = new ProductManager();

		$name = htmlspecialchars($_POST['name']);
		$amount = htmlspecialchars($_POST['amount']);
		$cost = htmlspecialchars($_POST['cost']);
		$production_date =  htmlspecialchars($_POST['production_date']); 
		$procomp_id = htmlspecialchars($_POST['procomp_id']);
		$rate = htmlspecialchars($_POST['rate']);
		$selectedImageURL = htmlspecialchars($_POST['selectedImageURL']);
		$aboutproduct = htmlspecialchars($_POST['aboutproduct']);
		$date_of_expose = date('Y-m-d');
		$date_of_modify = date('Y-m-d');
		
		//replace in product and procomp table
		
		$replacedProduct = $product->updateQuery("UPDATE procomp 
			SET
			amount = '$amount',
			cost = '$cost',
			production_date = '$production_date',
			image = '$selectedImageURL',
			description = '$aboutproduct',
			date_of_expose = '$date_of_expose',
			date_of_modify = '$date_of_modify'
			WHERE procomp_id = '$procomp_id';	

			");	
		if($replacedProduct!==false)
			echo "replaced successfully";

?>