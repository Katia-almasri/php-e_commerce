<?php
	
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Admin.php';
	require_once 'AdminManager.php';
	require_once 'DBManager.php';
	
	function checkValidationString($submittedItem){
		if(is_numeric($submittedItem))
			return false;
		return true;
		
	}
	
	function checkValidationNum($submittedItem){
		if(is_numeric($submittedItem))
		{
			
			return true;}
		
		return false;
		
	}
	
	function checkDateInput($inputdate){
		
		$todayDate = date("Y-m-d");
		if($inputdate>$todayDate)
			return false;
		return true;
	}
	
	function checkNameExist($inputName, $tableName, $col){
		
		$E = new DBManager();  
		
		$data = $E->selectQuery("SELECT * FROM `{$tableName}` WHERE `{$col}` = '$inputName'", "$tableName");
		if($data!==NULL){
			
			return true;
		}
		echo " ALl true";
		return false;
	}
	
	function checkNameAddition($name){
		
		$product = new DBManager();
		$data = $product->selectQuery("SELECT id FROM product WHERE name='$name'", "Product");
		if($data!==NULL){
			
			for($i = 0; $i<sizeof ($data); ++$i){
				$res[] = $data[$i]['id'];
				
			}
			$data = $product->selectQuery("SELECT com_id, pro_id FROM procomp WHERE pro_id IN (".implode(",", $res).")", "procomp");
			if($data!==NULL)//should convert number to string 
				return json_encode($data);
			return 'NULL';
			
		}
		return 'NULL';
	}

	function getItems($order_id, $order_type){
    $shipment = new DBManager();
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
  	echo "hello";
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

  function getProducerINFO($product_type, $product_id){
		$C = new DBManager();
		if($product_type==='procomp'){
			$result = $C->selectQuery("SELECT procomp.*, company.* FROM procomp INNER JOIN company ON company.com_id = procomp.com_id WHERE procomp.procomp_id = '$product_id'");
			if($result!==NULL)
				return $result;
			else
				return [];
		}else if($product_type==='proclient'){
			$result = $C->selectQuery("SELECT proclient.*, client.* FROM proclient INNER JOIN client ON client.client_id = proclient.client_id WHERE proclient.proclient_id = '$product_id'");
			if($result!==NULL)
				return $result;
			else
				return [];
		}
	}





?>