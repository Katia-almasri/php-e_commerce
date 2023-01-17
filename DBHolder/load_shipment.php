<?php
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Admin.php';
	require_once 'AdminManager.php';
  require_once 'auxFunctions.php';

	



	 function client_orders(){
    //orders from client orders and shipmetn company
    
    $today = date('Y-m-d');

    $shipment = new AdminManager();
    $outputString = '';
    $client_orders = $shipment->selectQuery("SELECT * FROM order_client WHERE DATE_FORMAT(date_order, '%Y-%m-%d') = '$today';");
    if($client_orders!==NULL){
      for($i = 0; $i<sizeof($client_orders); $i++){
        $cl_or_id = $client_orders[$i]['order_id'];
        $shipment_id = $client_orders[$i]['shipment_id'];
        $original_date = $client_orders[$i]['date_order'];
         $createDate = new DateTime($original_date);
        $eliminateTime = $createDate->format('Y-m-d');

        $shipments = $shipment->selectQuery("SELECT shipment_name FROM shipment WHERE shipment_id='$shipment_id'");
        $shipment_name = $shipments[0]['shipment_name'];

        $outputString.='<li id="'.$cl_or_id.'">';
        $outputString.='shipment name: '.$shipment_name.'<br>shipment_id: '.$shipment_id.'<br>order number: '.$client_orders[$i]['order_id'].'<br>total cost: '.$client_orders[$i]['tot_cost'].'<br>type of reciever: client<br>client_id: '.$client_orders[$i]['client_id'].'<br>number of items: '.$client_orders[$i]['item_num'].'<br>type of paid: '.$client_orders[$i]['type_paid'].'<br>date of order arrive: '.$today.'<br>date of order: '.$eliminateTime.'<br>';
        $item_component = getItems($cl_or_id, 'client');
        if(!empty($item_component))
        for($j = 0; $j<sizeof($item_component); $j++){
          $outputString.='product name: '.$item_component[$j]['product_name'].'<br>amount: '.$item_component[$j]['amount'].'<br>cost: '.$item_component[$j]['cost'].'<br>discount percent: '.$item_component[$j]['doscount_percent'].'<br>';

        }
        $outputString.='</li>++++++++++++++++++++++++++++++++++++<br>';
      }
       $count = sizeof($client_orders);
			$array = array(
	   		'event' => $outputString,
	   		'unseen_notification'  => $count
			);

		return $array;
    }
   else
    { $array = array(
   		'event' => '',
   		'unseen_notification'  => 0
	);
	return $array; 
	}
}

	function company_orders(){
    //orders from client orders and shipmetn company
    
    $today = date('Y-m-d');
    $shipment = new AdminManager();
    $outputString = '';
    $company_orders = $shipment->selectQuery("SELECT * FROM order_comp WHERE DATE_FORMAT(date_order, '%Y-%m-%d') = '$today'; ;");
    if($company_orders!==NULL){
      for($i = 0; $i<sizeof($company_orders); $i++){
        $co_or_id = $company_orders[$i]['order_id'];
        $shipment_id = $company_orders[$i]['shipment_id'];
        $original_date = $company_orders[$i]['date_order'];
        $createDate = new DateTime($original_date);
        $eliminateTime = $createDate->format('Y-m-d');

        $shipments = $shipment->selectQuery("SELECT shipment_name FROM shipment WHERE shipment_id='$shipment_id'");
        $shipment_name = $shipments[0]['shipment_name'];

        $outputString.='<li id="'.$co_or_id.'">';
        $outputString.='shipment name: '.$shipment_name.'<br>shipment_id: '.$shipment_id.'<br>order number: '.$company_orders[$i]['order_id'].'<br>total cost: '.$company_orders[$i]['tot_cost'].'<br>type of reciever: company<br>company_id: '.$company_orders[$i]['comp_id'].'<br>number of items: '.$company_orders[$i]['items_num'].'<br>type of paid: '.$company_orders[$i]['type_paid'].'<br>date of order arrive: '.$today.'<br>date of order: '.$eliminateTime.'<br>';
        $item_component = getItems($co_or_id, 'company');
        if(!empty($item_component))
        for($j = 0; $j<sizeof($item_component); $j++){
          $outputString.='product name: '.$item_component[$j]['product_name'].'<br>amount: '.$item_component[$j]['amount'].'<br>cost: '.$item_component[$j]['cost'].'<br>discount percent: '.$item_component[$j]['discount_percent'].'<br>';

        }
        $outputString.='</li>++++++++++++++++++++++++++++++++++++<br>';
      }
     
      $count = sizeof($company_orders);
			$array = array(
	   		'event' => $outputString,
	   		'unseen_notification'  => $count
			);
		return $array;
    }
    else
      {$array = array(
   		'event' => '',
   		'unseen_notification'  => 0
	);
	return $array; } 
  
    
  }

	$client_order = client_orders();
	$company_order = company_orders();

	$outputString = $client_order['event'].$company_order['event'];
	$cnt = $client_order['unseen_notification']+$company_order['unseen_notification'];

	if($outputString==='')
		$outputString = '<li>no new shipment orders</li>';
	$array = $array = array(
   		'event' => $outputString,
   		'unseen_notification'  => $cnt
	);

	echo json_encode($array);

	
?>