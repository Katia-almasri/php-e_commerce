<?php

	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	require_once 'CompanyManager.php';

	function getNumOrderTillNow($comp_id){
		$company = new CompanyManager();
		$numOrder = $company->selectQuery("SELECT COUNT(order_id) AS num_order FROM order_comp WHERE comp_id = '$comp_id'");
		if($numOrder!==NULL)
			return $numOrder[0]['num_order'];
		return 0;
	}


	function REVENUE($comp_id)
	{
		$company = new CompanyManager();
		$revenue = $company->selectQuery("SELECT SUM(tot_cost) AS tot_cost FROM item_comp WHERE comp_id = '$comp_id'");
		if($revenue[0]['tot_cost']!==NULL)
			return $revenue[0]['tot_cost'];
		else if($revenue[0]['tot_cost']==NULL)
			return 0;
	}

	function getNumproduct($comp_id){
		$company = new CompanyManager();
		$numpro = $company->selectQuery("SELECT COUNT(procomp_id) AS num_pro FROM procomp WHERE com_id = '$comp_id'");
		if($numpro!==NULL)
			return $numpro[0]['num_pro'];
		return 0;
	}

	function get($comp_id){
		$company = new CompanyManager();
		$numpro = $company->selectQuery("SELECT COUNT(com_id) AS num_pro FROM procomp WHERE comp_id = '$comp_id'");
		if($numpro!==NULL)
			return $numpro[0]['num_pro'];
		return 0;
	}

	function getNumsell($comp_id){
		$company = new CompanyManager();
		$numsell = $company->selectQuery("SELECT SUM(num_sell) AS num FROM procomp WHERE com_id = '$comp_id'");
		if($numsell[0]['num']!==NULL)
			return $numsell[0]['num'];
		else if($numsell[0]['num']==NULL)
		return 0;
	}

	function showpruduct($comp_id)
	{
	$pdo = pdo_connect_mysql();
    $stmt = $pdo->prepare("SELECT pro_name,amount,cost,rate from procomp where comp_id = '$comp_id' ");
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
	}

		function getSumOfSoldProducts($comp_id){
		$company = new CompanyManager();
		$sumNumSellPro = $company->selectQuery("SELECT sum_1+sum_2 AS tot_sum FROM (SELECT SUM(proclient.num_sell) FROM item_client INNER JOIN proclient ON proclient.proclient_id = item_client.type_id WHERE proclient.client_id = '$comp_id' AND proclient.client_id = '$client_id') AS num_1,(SELECT SUM(proclient.num_sell) FROM item_comp INNER JOIN proclient ON proclient.proclient_id = item_comp.type_id WHERE proclient.client_id = '$client_id' AND proclient.client_id = '$client_id') AS sum_2");
		if($sumNumSellPro!==NULL)
			return $sumNumSellPro[0]['tot_sum'];
		return 0;
	}

	function getAmountfItems($comp_id){
		$company = new CompanyManager();
		$sumSoldPro = $company->selectQuery("SELECT sum_1+sum_2 AS tot_cost FROM (SELECT SUM(tot_cost) FROM item_comp INNER JOIN procomp ON procomp.procomp_id = item_comp.type_id where item_comp.type='procomp' AND procomp.com_id = '$comp_id' AS sum_1), (SELECT SUM(tot_cost) FROM item_comp INNER JOIN procomp ON procomp.procomp_id = item_comp.type_id where item_comp.type='procomp' AND procomp.com_id = '$comp_id' AS sum_1)");
		if($sumSoldPro!==NULL)
			return $sumSoldPro[0]['tot_cost'];
		return 0;
	}

	function getMostSoldProduct($comp_id){
		$company = new CompanyManager();
		$cntMostSoldPro = $company->selectQuery("SELECT pro_name, num_sell FROM procomp WHERE com_id = '$comp_id' GROUP BY MAX(num_sell) AS nu_sell");
		if($cntMostSoldPro!==NULL)
			return $cntMostSoldPro;
		return NULL;

	}



		function getItems($order_id, $order_type){
    		$company = new CompanyManager();
    		$item_order = $company->selectQuery("SELECT item_comp.*, 
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




?>