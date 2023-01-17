<?php
	require_once 'AdminManager.php';
	require_once 'ProductManager.php';

	$ann_ord_id = htmlspecialchars($_POST['ann_ord_id']);
	//accept 

	$admin = new AdminManager();
	
	$extractAnn = $admin->selectQuery("SELECT * FROM announcement_orders WHERE a_o_id = '$ann_ord_id'");
	if($extractAnn!==NULL){
		$type = $extractAnn[0]['type'];
		$type_id = $extractAnn[0]['type_id'];
		$image = $extractAnn[0]['image'];
		$start_of_ann = $extractAnn[0]['start_of_ann'];
		$time_on_id = $extractAnn[0]['time_on_id'];
		
		echo $type.'<br>'.$start_of_ann.'<br>';
		//insert there info into announcement table
		$insertAnn = $admin->insertQuery("INSERT INTO announcement(type, type_id, image, time_an_id, start_of_ann) VALUES('$type', '$type_id', '$image', '$time_on_id', '$start_of_ann');");
		if($insertAnn!==false){
			//update announcment_orders
			$acceptOrders = $admin->updateQuery("UPDATE announcement_orders SET 
				is_processed = 1, 
				is_accepted = 1
				WHERE a_o_id = '$ann_ord_id';
				");
		}
	}else
	echo "NOT ";







?>