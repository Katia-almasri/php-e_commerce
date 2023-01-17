<?php

	require 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require 'ProductManager.php';
	require 'ClientManager.php';
	
	session_start();
	if(isset($_SESSION['email'])){
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
	}
	
	$product = new ClientManager();
	
	$proclient_id = $_POST['proclient_id'];
	$result = $product->deleteQuery("DELETE  FROM proclient WHERE proclient_id='$proclient_id'");

	if($result!==false){
		
		echo "Done";
		
	}else if($result===true){
		echo'There is no item in this id to delete.. ';
		
	}


?>