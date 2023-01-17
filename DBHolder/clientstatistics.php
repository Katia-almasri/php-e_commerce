<?php

	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	require_once 'ClientManager.php';

	function getNumOrderTillNow($client_id){
		$client = new ClientManager();
		$numOrder = $client->selectQuery("SELECT COUNT(order_id) AS num_order FROM order_client WHERE client_id = '$client_id'");
		if($numOrder!==NULL)
			return $numOrder[0]['num_order'];
		return 0;
	}

	function getSumOfSoldProducts($client_id){
		$client = new ClientManager();
		$sumNumSellPro = $client->selectQuery("SELECT sum_1+sum_2 AS tot_sum FROM (SELECT SUM(proclient.num_sell) FROM item_client INNER JOIN proclient ON proclient.proclient_id = item_client.type_id WHERE proclient.client_id = '$client_id' AND proclient.client_id = '$client_id') AS num_1,(SELECT SUM(proclient.num_sell) FROM item_comp INNER JOIN proclient ON proclient.proclient_id = item_comp.type_id WHERE proclient.client_id = '$client_id' AND proclient.client_id = '$client_id') AS sum_2");
		if($sumNumSellPro!==NULL)
			return $sumNumSellPro[0]['tot_sum'];
		return 0;
	}

	function getAmountfItems($client_id){
		$client = new ClientManager();
		$sumSoldPro = $client->selectQuery("SELECT SUM(tot_cost) AS tot_cost FROM order_client WHERE client_id = '$client_id'");
		if($sumSoldPro!==NULL)
			return $sumSoldPro[0]['tot_cost'];
		return 0;
	}

	function getMostSoldProduct($client_id){
		$client = new ClientManager();
		$cntMostSoldPro = $client->selectQuery("SELECT pro_name, num_sell FROM proclient WHERE client_id = '$client_id' GROUP BY MAX(num_sell) AS nu_sell");
		if($cntMostSoldPro!==NULL)
			return $cntMostSoldPro;
		return NULL;

	}

	function getItems($order_id, $order_type){
    		$client = new ClientManager();
    		$item_order = $client->selectQuery("SELECT item_client.*, 
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

 }

	 


?>