<?php
	
	require_once 'ClientManager.php';
	require_once 'clientstatistics.php';

	$cnt = htmlspecialchars($_POST['cnt_order']);
	$client_id = htmlspecialchars($_POST['client_id']);
	$client = new ClientManager();
	$lastOrder = $client->selectQuery("SELECT * FROM order_client WHERE client_id = '$client_id' ORDER BY date_order DESC LIMIT $cnt;");
	$outputString = '';
	if($lastOrder!==NULL){
      	for($j=0; $j<sizeof($lastOrder); $j++){
      		    $items = getItems($lastOrder[$j]['order_id'], 'client');
          		for($i = 0; $i<sizeof($items); $i++){
          			$outputString.='<li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">'.$items[$i]['product_name'].'</h6>
            <small class="text-muted">amount: '.$items[$i]['amount'].'</small>
          </div>
          <span class="text-muted">'.$items[$i]['tot_cost'].'$</span>
        </li>';
		
		}
		echo "<br>";
		$outputString.='<li class="list-group-item d-flex justify-content-between bg-light">
          <div class="text-success">
            <h6 class="my-0">Promo code</h6>
            <small>EXAMPLECODE</small>
          </div>
          <span class="text-success">-$5</span>
        </li>

        <li class="list-group-item d-flex justify-content-between">
          <span>Total (USD)</span>
          <strong>'.$lastOrder[$j]['cost_with_shipment'].'</strong>
        </li>';		
		
          

		}
		echo $outputString;
		
	}else
	 echo '<li class="list-group-item d-flex justify-content-between lh-condensed" ><div>no more orders</div></li>';
         

	
?>