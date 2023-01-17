<?php

	require '../AdminManager.php';
	
	
	$deleteProduct = new AdminManager();
	$result = '';
	$product_id  = htmlspecialchars($_POST['product_id']);
	$type = htmlspecialchars($_POST['type']);
	if($type==='procomp'){
		$result = $deleteProduct->deleteQuery("DELETE  FROM procomp WHERE procomp_id='$product_id'");

	}else if($type==='proclient'){
		$result = $deleteProduct->deleteQuery("DELETE  FROM proclient WHERE proclient_id='$product_id'");

	}


	if($result!==false){
		
		echo "Done";
		
	}else if($result===true){
		echo'There is no item in this id to delete.. ';
		
	}


?>