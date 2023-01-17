<?php

	require 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require 'ProductManager.php';
	require 'CompanyManager.php';
	
	session_start();
	if(isset($_SESSION['email'])){
		$email = $_SESSION['email'];
		$psd = $_SESSION['psd'];
	}
	
	$product = new CompanyManager();
	
	$procomp_id = $_POST['procomp_id'];
	$result = $product->deleteQuery("DELETE  FROM procomp WHERE procomp_id='$procomp_id'");

	if($result!==false){
		
		echo "Done";
		
	}else if($result===true){
		echo'There is no item in this id to delete.. ';
		
	}


?>