<?php
	require_once 'AdminManager.php';
	require_once 'DBManager.php';
  require_once 'auxFunctions.php';

	$shipment = new DBManager();
	$shipment_id = htmlspecialchars($_POST['shipment_id']);
  $order_type = htmlspecialchars($_POST['order_type']);
  $order_type_id = htmlspecialchars($_POST['order_type_id']);

  function moreDetailINFO($buyier_type, $buyier_id, $order_id){
    //1]give information about buyier
    $output = '';
    if($buyier_type==='client'){
      $Detail = new DBManager();
    $buyerINFO = $Detail->selectQuery("SELECT * FROM client WHERE client_id = '$buyier_id'");
    if($buyerINFO!==NULL){
      $output.='client name: '.$buyerINFO[0]['username'].'<br>location: '.$buyerINFO[0]['location'].'<br>email: '.$buyerINFO[0]['email'].'<br>'; //should add governate
    }

    //2]give info about each item in this order
    $itemINFO = getItems($order_id, $buyier_type);
    for ($i=0; $i <sizeof($itemINFO) ; $i++) { 
       $stringToMail.='product name: '.$itemINFO[$i]['product_name'].'<br>amount: '.$itemINFO[$i]['amount'].'<br>cost: '$itemINFO[$i]['cost'].'<br>Total cosr for this product: '.$itemINFO[$i]['dod_cost'].'<br>Sum of discount product: '.$itemINFO[$i]['sum_dis_pro'].'<br>Total cost(After all discounts: )'.$itemINFO[$i]['cost_after_dis'].'<br>Item weight'.$itemINFO[$i]['item_weight'].'<br>';
     } 
    //3]give info about each company have this item


  }else if($buyier_type==='company'){
    $Detail = new DBManager();
    $buyerINFO = $Detail->selectQuery("SELECT * FROM company WHERE com_id = '$buyier_id'");
    if($buyerINFO!==NULL){
      $output.='company name: '.$buyerINFO[0]['name'].'<br>location: '.$buyerINFO[0]['location'].'<br>email: '.$buyerINFO[0]['email'].'<br>'; //should add governate
    }
  }
    
  }
  //1.send email to shipper with the new order
  //2.this order will be inserted in shipment order queue
  if($order_type==='client'){
    $order_info = $shipment->selectQuery("SELECT * FROM order_client WHERE order_id = '$order_type_id'");
    if($order_info!==NULL){
      $stringToMail = '';
        $stringToMail.='new client order should be recieved..<br>Detail of order: ';
        $stringToMail.='Order id: '.$order_info[0]['order_id'].'<br>Date of order: '.$order_info[0]['date_order'].'<br>Total cost: '.$order_info[0]]['tot_cost'].'<br>number of items: '.$order_info[0]['item_num'].'<br>type of paying: '.$order_info[0]['type_paid'].'<br>Markteck profit with all disounts: '.$order_info[0]['admin_pro_with_dis'].'<br>Total sum of item weight: '.$order_info[0]['sum_item_weight'].'<br>Shipment cost: '.$order_info[0]['shipment_cost'].'<br>Total cost should client pay(with shipment fee): '.$order_info[0]['cost_with_shipment'].'<br>';
        $stringToMail.=moreDetailINFO('client', $order_info[0]['client_id'], $order_info[0]['order_id']);
      
    }

  }else if($order_type==='company'){
    $order_info = $shipment->selectQuery("SELECT * FROM order_comp WHERE order_id = '$order_type_id'");
    if($order_info!==NULL){
      $stringToMail = '';
        $stringToMail.='new company order should be recieved..<br>Detail of order: ';
        $stringToMail.='Order id: '.$order_info[0]['order_id'].'<br>Date of order: '.$order_info[0]['date_order'].'<br>Total cost: '.$order_info[0]]['tot_cost'].'<br>number of items: '.$order_info[0]['item_num'].'<br>type of paying: '.$order_info[0]['type_paid'].'<br>Markteck profit with all disounts: '.$order_info[0]['admin_pro_with_dis'].'<br>Total sum of item weight: '.$order_info[0]['sum_item_weight'].'<br>Shipment cost: '.$order_info[0]['shipment_cost'].'<br>Total cost should company pay(with shipment fee): '.$order_info[0]['cost_with_shipment'].'<br>';
          $stringToMail.=moreDetailINFO('company', $order_info[0]['comp_id'], $order_info[0]['order_id']);

      
    }

  }

       
  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title>shipment process</title>
    <script src="jquery.js"></script>

  </head>
  <body>

  </body>
  </html>