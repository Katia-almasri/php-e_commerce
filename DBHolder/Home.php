<?php
	require_once 'DBManager.php';
	require_once 'ProductManager.php';
	require_once 'ClientManager.php';

	/*session_start();
	if(isset($_SESSION['cliet_id'])){
		$cliet_id = $_SESSION['cliet_id'];
		$password = $_SESSION['password'];
		$email = $_SESSION['email'];
	}*/

	$product = new ProductManager();
	$num_sell = $product->selectQuery("SELECT * FROM `proclient` UNION SELECT * FROM `procomp` ORDER BY num_sell DESC LIMIT 20");
		print_r($num_sell);

	$num_likes = $product->selectQuery("SELECT * FROM `proclient` UNION SELECT * FROM `procomp` ORDER BY num_likes DESC LIMIT 20");
	echo "<br>***************************************<br>";
	print_r($num_likes);









?>