<?php
	require 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require 'ProductManager.php';
	
	$product = new ProductManager();
	$data = json_decode($product->getAllProducts());
	
?>