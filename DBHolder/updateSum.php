<?php

	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Admin.php';
	require_once 'CompanyManager.php';
	require_once 'ClientManager.php';
	require_once 'DBManager.php';

	$bell_id = '';
	$sum = 0;

	$bell_id = htmlspecialchars($_POST['bell_id']);
	$sum = htmlspecialchars($_POST['sum']);

	$shipment = new DBManager();
	$editedSum = $shipment->updateQuery("UPDATE shipment_bell SET 
			smu = '$sum'
			where 	bell_id = '$bell_id';
		");
	if($editedSum!==false){
		echo "done";
	}else
	echo "error";
	
?>