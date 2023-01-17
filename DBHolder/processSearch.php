<?php
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\client.php';
	require_once 'ClientManager.php';
	require_once 'auxFunctions.php';

	$product = new ClientManager();
	$data = $product->selectQuery("SELECT DISTINCT product.name FROM procomp, product, proclient WHERE procomp.pro_id = product.pro_id OR proclient.pro_id = product.pro_id");
	
	if(isset($_POST['submit-search'])){
	//////code...
	
}
	if(isset($_POST['suggestion'])){
	$q = $_POST['suggestion'];
	
	$suggestion = '';
		if($q !==''){
			$q = strtolower($q);
			$len = strlen($q);
			
			foreach ($data as $key => $value) {
				foreach ($value as $k => $v) {
			
					if(stristr($q, substr($v, 0, $len))){
					if($suggestion == '')
						$suggestion = '<a href="#">'.$v.'</a>';
					else
						$suggestion.='<br><a href="#">'.$v.'</a>';
				}
								
			
		}
			
	}
				
			
	echo $suggestion==''? 'No suggestion':$suggestion;		
		
		
	}
	

}

?>