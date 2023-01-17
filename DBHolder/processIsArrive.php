<?php

	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Admin.php';
	require_once 'CompanyManager.php';
	require_once 'ClientManager.php';
	require_once 'DBManager.php';

	$ch = htmlspecialchars($_POST['ch']);
	$ord_type_id = htmlspecialchars($_POST['ord_type_id']);
	$type = htmlspecialchars($_POST['type']);
	echo $ch;
	$ship = new DBManager();
	if($type === 'client'){
		if($ch==1){
		$result = $ship->updateQuery("UPDATE order_client SET 
			is_seen = 1
			WHERE order_id = '$ord_type_id';
			");
		if($result===true){
			echo "DONE";
		}
	}
	}

	else if($type === 'company'){
		if($ch==1){
		$result = $ship->updateQuery("UPDATE order_comp SET 
			is_seen = 1
			WHERE order_id = '$ord_type_id';
			");
		if($result===true){
			echo "DONE";
		}
	}
	}
	
?>