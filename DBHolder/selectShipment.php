<?php
	require_once 'DBManager.php';
	require_once 'ProductManager.php';

		$shipment = new DBManager();
		
		$output = '';
		$count = 0;

		$shipment_id = htmlspecialchars($_GET['shipment_id']);

	  function getItems($order_id, $order_type){
    $shipment = new AdminManager();
    if($order_type === 'client')
    {
      $item_order = $shipment->selectQuery("SELECT item_client.*, 
      CASE 
      WHEN item_client.type = 'procomp' THEN procomp.pro_name
      WHEN item_client.type = 'proclient' THEN proclient.pro_name
      ELSE NULL
      END AS product_name
      FROM item_client 
      LEFT JOIN procomp ON procomp.procomp_id = item_client.type_id 
      LEFT JOIN proclient ON proclient.proclient_id = item_client.type_id
      WHERE item_client.order_id = '$order_id'");
      if($item_order!==NULL)
        return $item_order;
      else
        return [];

  }else if($order_type === 'company'){
    $item_order = $shipment->selectQuery("SELECT item_comp.*, 
      CASE 
      WHEN item_comp.type = 'procomp' THEN procomp.pro_name
      WHEN item_comp.type = 'proclient' THEN proclient.pro_name
      ELSE NULL
      END AS product_name
      FROM item_comp 
      LEFT JOIN procomp ON procomp.procomp_id = item_comp.type_id 
      LEFT JOIN proclient ON proclient.proclient_id = item_comp.type_id
      WHERE item_comp.order_id = '$order_id'");
      if($item_order!==NULL)
        return $item_order;
      else
        return [];
}

  }

      $sql1 = $shipment->selectQuery("SELECT * FROM shipment_bell WHERE is_recieved = 0 AND is_arrived = 0 AND shipment_id = '$shipment_id' AND sum = 0");
      if($sql1!==NULL)
      {
      	$count1 = sizeof($sql1);
      	
      	 for($i = 0; $i<sizeof($sql1); ++$i){
      	 	$bell_id = $sql1[$i]['bell_id'];
		  	$output .= '<li id="$bell_id">';
		  	$output.="owner of order type: ".$sql1[$i]['type_order'].'<br>order id: '.$sql1[$i]['order_id'].'<br>';
		  	$output.="shipment cost of this order is: ".$sql1[$i]['sum'].'<br>';
		  	}
		  	$count = sizeof($sql1);
			$array = array(
   	'notification_count' => $output,
   	'num'  => $count
	);
	 echo  json_encode($array);
	}
	
  else{
  	$array = array(
   'notification_count' => '<li>no new shipment orders</li>',
   'num'  => 0
);

  	echo json_encode($array);
  }

  ?>