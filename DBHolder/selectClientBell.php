<?php
	require_once 'ClientManager.php';
	require_once 'ProductManager.php';

		$client = new ClientManager();
		$client_id = htmlspecialchars($_GET['client_id']);
		
		$output = '';
		$count = 0;

      $sql1 = $client->selectQuery("SELECT * FROM client_bell WHERE is_seen = 0 AND client_id = '$client_id'");
      if($sql1!==NULL)
      {
      	    
		$count = sizeof($sql1);
		$array = array(
   'event' => '',
   'unseen_notification'  => $count
	);
	 echo  json_encode($array);
	 
  }else{
  	$array = array(
   'event' => 'no new notification',
   'unseen_notification'  => $count
);

  	echo json_encode($array);
  }
  	

       
  ?>