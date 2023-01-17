<?php

	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	require_once 'CompanyManager.php';

	$email = htmlspecialchars($_POST['email']);

	$company = new CompanyManager();
	$our_info = $company->selectQuery("")



?>