<?php
	
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	require_once 'ClientManager.php';

	$Product = new ProductManager();
	$client_id = htmlspecialchars($_GET['client_id']);
	$products = $Product->selectQuery("SELECT * FROM proclient WHERE client_id = '$client_id'");
	$output = '';
	$count = 0;
	if($products!==NULL){

		$count = $sizeof($products);
		 for($i = 0; $i<sizeof($products); ++$i){
      	 	$proclient_id = $products[$i]['proclient_id'];
      	 	$output.='<div id="$proclient_id">';
      	 	$output.="<img src='$img' id='img_pro' width='100' height='100' class='des-Img'>";
	 		$output.='product name: '.$products[$i]['pro_name'].'<br>amount: '.$products[$i]['amount'].'<br>cost: '.$products[$i]['cost'].'<br>production date: '.$products[$i]['production_date'].'<br>';
	 		$output.="<input type='button' id='$proclient_id' class='edit_pro' value='edit'>";
	 		$output.="<input type='button' id='$proclient_id' class='remove_pro' value='remove'></div>";
		  

		}

			$data = array(
   		     'products' => $output,
  			 'num'  => $count
			);
  		echo json_encode($data);
	}
	else
	{
		$output.='<div>no more clients now</div>';
		$data = array(
   		'products' => $output,
   		'num'  => 0
		);

  		echo json_encode($data);
  	}

?>
