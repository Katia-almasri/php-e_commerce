<?php
	require_once 'DBManager.php';
	require_once 'ProductManager.php';

	$manager = new ProductManager();
	$result = $manager->selectQuery("SELECT CURDATE()");

	print_r($result);
	echo "c";

?>