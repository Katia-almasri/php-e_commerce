<?php
	
	require_once 'DBManager.php';

	$is_recieved = htmlspecialchars($_POST['is_recieved']);
	$is_arrived = htmlspecialchars($_POST['is_arrived']);
	$bell_id = htmlspecialchars($_POST['bell_id']);

	$recieve = 0;
	$arrive = 0;
	echo $is_recieved.'<br>';
	echo $is_arrived.'<br>';
	if($is_recieved==='true')
		$recieve = 1;
	if($is_arrived==='true')
		$arrive = 1;
	$shipment = new DBManager();
	$changedOrder = $shipment->updateQuery("UPDATE shipment_bell
			SET
			is_recieved = '$recieve',
			is_arrived = '$arrive'
			WHERE bell_id = '$bell_id';
		");
	if($recieve==1 && $arrive==1){
		//this order is already reached and should send to order table
	}
	if($changedOrder!==false)
		echo "done";
	else
		echo "problem!";

?>