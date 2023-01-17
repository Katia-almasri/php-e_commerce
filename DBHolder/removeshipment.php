<?php
	require_once 'AdminManager.php';
	require_once 'ProductManager.php';

  $cnt = htmlspecialchars($_POST['cnt_ship']);
  $GLOBALS['cnt'] = $cnt;
  
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
      WHERE item_client.order_client_id = '$order_id'");
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
      WHERE item_comp.order_comp_id = '$order_id'");
      if($item_order!==NULL)
        return $item_order;
      else
        return [];
  }

  }


  function client_orders(){
    //orders from client orders and shipmetn company
    $cnt = $GLOBALS['cnt'];
    $today = date('Y-m-d');
    $shipment = new AdminManager();
    $outputString = '';
    $client_orders = $shipment->selectQuery("SELECT * FROM order_client WHERE DATE_FORMAT(date_order, '%Y-%m-%d') = '$today'LIMIT $cnt;");
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
        $outputString.='shipment name: '.$shipment_name.'<br>shipment_id: '.$shipment_id.'<br>order number: '.$client_orders[$i]['order_id'].'<br>total cost: '.$client_orders[$i]['tot_cost'].'<br>type of reciever: client<br>company_id: '.$client_orders[$i]['client_id'].'<br>number of items: '.$client_orders[$i]['item_num'].'<br>type of paid: '.$client_orders[$i]['type_paid'].'<br>date of order arrive: '.$today.'<br>date of order: '.$eliminateTime.'<br>';
        $item_component = getItems($cl_or_id, 'client');
        if(!empty($item_component))
        for($j = 0; $j<sizeof($item_component); $j++){
          $outputString.='product name: '.$item_component[$j]['product_name'].'<br>amount: '.$item_component[$j]['amount'].'<br>cost: '.$item_component[$j]['cost'].'<br>discount percent: '.$item_component[$j]['doscount_percent'].'<br>';

        }
        $outputString.='</li>++++++++++++++++++++++++++++++++++++<br>';
      }
        return $outputString;
    }
   else
      return $outputString;
}

    function company_orders(){
    //orders from client orders and shipmet company
    $cnt = $GLOBALS['cnt'];
    $today = date('Y-m-d');
    $shipment = new AdminManager();
    $outputString = '';
    $company_orders = $shipment->selectQuery("SELECT * FROM order_comp WHERE DATE_FORMAT(date_order, '%Y-%m-%d') = '$today' LIMIT $cnt;");
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
        $outputString.='shipment name: '.$shipment_name.'<br>shipment_id: '.$shipment_id.'<br>order number: '.$company_orders[$i]['order_id'].'<br>total cost: '.$company_orders[$i]['tot_cost'].'<br>type of reciever: company<br>client_id: '.$company_orders[$i]['comp_id'].'<br>number of items: '.$company_orders[$i]['items_num'].'<br>type of paid: '.$company_orders[$i]['type_paid'].'<br>date of order arrive: '.$today.'<br>date of order: '.$eliminateTime.'<br>';
        $item_component = getItems($co_or_id, 'company');
        if(!empty($item_component))
        for($j = 0; $j<sizeof($item_component); $j++){
          $outputString.='product name: '.$item_component[$j]['product_name'].'<br>amount: '.$item_component[$j]['amount'].'<br>cost: '.$item_component[$j]['cost'].'<br>discount percent: '.$item_component[$j]['discount_percent'].'<br>';

        }
        $outputString.='</li>++++++++++++++++++++++++++++++++++++<br>';
      }
     
     return $outputString;
    }
    else
      return $outputString; 
  
    
  }

  $client_order = client_orders();
  $company_order = company_orders();
  $EVENTS = $client_order.$company_order;
  echo $EVENTS;

    
  
  ?>