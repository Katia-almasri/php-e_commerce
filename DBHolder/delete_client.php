<?php
	require_once 'ClientManager.php';

	$client_id = htmlspecialchars($_POST['client_id']);

	$client = new ClientManager();
	$data = $client->deleteQuery("DELETE FROM client WHERE client_id = '$client_id'");
	if($data!==false)
		{
			echo "client deleted successfully";
			//email this client
		}
		else
			echo "some error happend!!";



?>