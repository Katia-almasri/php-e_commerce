<?php

	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	require_once 'CompanyManager.php';

	$type = htmlspecialchars($_POST['type']);
	$pro_id = htmlspecialchars($_POST['pro_id']);


	$product = new ProductManager();
	if($type==='procomp')
	{
		$pro = $product->selectQuery("SELECT * FROM procomp WHERE procomp_id = '$pro_id'");
		if($pro!==NULL)
			return ($pro);
		
	}else if($type==='proclient')
	{
		$pro = $product->selectQuery("SELECT * FROM proclient WHERE proclient_id = '$pro_id'");
		if($pro!==NULL)
			return($pro);
	}
	


	

?>