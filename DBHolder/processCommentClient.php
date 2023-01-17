<?php
		
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ClientManager.php';
	
	session_start();
	if(isset($_SESSION['password']))
	{
		
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
		echo $email.' %';
		$client_id = $_SESSION['client_id'];
		//should send procomp_id with session from home to product page
		$username = $_SESSION['username'];
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

	$username = htmlspecialchars($_POST['username']);
	$comment_field = htmlspecialchars($_POST['comment_field']);
	$type_product = htmlspecialchars($_POST['type_product']);
	$type_id = htmlspecialchars($_POST['type_id']);
	$client_id = htmlspecialchars($_POST['client_id']);
	$data_of_comment = date('Y-m-d');
	$client = new ClientManager();
	if($type_product=='procomp')
	{
		$insertComment = $client->insertQuery("INSERT INTO procomp_comment(write_comment_type, write_comment_id, comment_text, procomp_id, date_of_comment) 
			VALUES('client', '$client_id', '$comment_field', '$type_id', '$data_of_comment')
			;
			");
		if($insertComment!==false)
			echo "comment inserted into procomp_comment";

	}else if($type_product=='proclient'){
		$insertComment = $company->insertQuery("INSERT INTO proclient_comment(write_comment_type, write_comment_id, comment_text, procomp_id, date_of_comment) 
			VALUES('client', '$client_id', '$comment_field', '$type_id', '$data_of_comment')
			;
			");
		if($insertComment!==false)
			echo "comment inserted into proclient_comment";
	}






?>