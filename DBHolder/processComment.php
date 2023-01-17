<?php
		
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'CompanyManager.php';
	
	session_start();
	if(isset($_SESSION['psd']))
	{
		
		$email = $_SESSION['email'];
		$psd = $_SESSION['psd'];
		echo $email.' %';
		$com_id = $_SESSION['com_id'];
		//should send procomp_id with session from home to product page
		$name = $_SESSION['name'];
		//1.company name
		$imag = $_SESSION['image'];
		//2.company logo
		//1 & 2 for comment info 
		$type_product = $_SESSION['type_product'];
		//to know procomp or proclient product
		$type_id = $_SESSION['type_id'];
		//id of this product
	
	}else{
		echo 'you dont have permission to login this page';
		echo '<a href="login.php">LOGIN </a>';
		exit();
			
	}

	$name = htmlspecialchars($_POST['name']);
	$comment_field = htmlspecialchars($_POST['comment_field']);
	$type_product = htmlspecialchars($_POST['type_product']);
	$type_id = htmlspecialchars($_POST['type_id']);
	$com_id = htmlspecialchars($_POST['com_id']);
	$data_of_comment = date('Y-m-d');
	$company = new CompanyManager();
	if($type_product=='procomp')
	{
		$insertComment = $company->insertQuery("INSERT INTO procomp_comment(write_comment_type, write_comment_id, comment_text, procomp_id, date_of_comment) 
			VALUES('company', '$com_id', '$comment_field', '$type_id', '$data_of_comment')
			;
			");
		if($insertComment!==false)
			echo $comment_field;

	}else if($type_product=='proclient'){
		$insertComment = $company->insertQuery("INSERT INTO proclient_comment(write_comment_type, write_comment_id, comment_text, procomp_id, date_of_comment) 
			VALUES('company', '$com_id', '$comment_field', '$type_id', '$data_of_comment')
			;
			");
		if($insertComment!==false)
			echo $comment_field;
	}






?>