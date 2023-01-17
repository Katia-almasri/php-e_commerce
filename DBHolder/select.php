<?php
	require_once 'AdminManager.php';
	require_once 'ProductManager.php';

		$admin = new AdminManager();
		
		$output = '';
		$count = 0;
      $sql1 = $admin->selectQuery("SELECT * FROM notification WHERE is_procecced = 0");
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
   'event' => '',
   'unseen_notification'  => 0
);

  	echo json_encode($array);
  }
  	

       
  ?>