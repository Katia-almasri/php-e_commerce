<?php
	require_once 'AdminManager.php';
	require_once 'ProductManager.php';
	/*session_start();
	if(isset($_SESSION['email']){
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
	}else{
		echo "You dont have permission to login thi page!";
		exit();
	}*/

	function getDiscountProduct($pro_id){
		$today = date('Y-m-d');
		$admin = new AdminManager();
		$result = $admin->selectQuery("SELECT event.discount FROM discount_product INNER JOIN event ON event.event_id = discount_product.event_id WHERE discount_product.pro_id = '$pro_id'AND event.ed_date>='$today' AND event.st_date<='$today'");
		if($result!==NULL){
			$discount = $result[0]['discount'];
				return $discount;
		}return 0;
	}
	

	function notifyIfInWish($pro_id, $pro_name, $item){
		$subject = 'new product you may like';
		$bell_text = $pro_name.'has been added just now';
		$admin = new AdminManager();
		//notify client to product in wish list
		$new_pro = $admin->selectQuery("SELECT DISTINCT  wishList.client_id FROM wishList INNER JOIN product ON product.pro_id = wishList.pro_id WHERE product.item_id = '$item'");
		if($new_pro!==NULL)
		//notify client if similat product by item has been added
		{
				for($i = 0; $i<sizeof($new_pro); $i++){
					$client_id = $new_pro[$i]['client_id'];
					
				$client_bell = $admin->insertQuery("INSERT INTO client_bell(client_id, subject, bell_text, pro_id) VALUES('$client_id', '$subject', '$bell_text', '$pro_id') ;");	
				}
			
		}

				
	}

	$not_id = htmlspecialchars($_GET['not_id']);
	
	$admin = new AdminManager();
	$product = new ProductManager();
	
	$data = $admin->selectQuery("SELECT * FROM notification WHERE not_id = '$not_id'");
		$applicant  =$data[0]['applicant'];
		$applicant_id = $data[0]['applicant_id'];
		$pro_id = $data[0]['pro_id'];
		$date_of_expose = date('Y-m-d');
		$date_of_modify = date('Y-m-d');
		$amount = $data[0]['amount'];
		$cost = $data[0]['cost'];
		$production_date = $data[0]['production_date'];
		$discount_percent = $data[0]['discount_percent'];
		$rate = $data[0]['rate'];
		$num_likes = 0;
		$pro_name = $data[0]['pro_name'];
		$profit_id = 1; 
		$cur_amount = $amount;
		$num_sell = 0;
		$col = $data[0]['col'];
		$size = $data[0]['size'];
		$aboutproduct = $data[0]['description'];
		$selectedImageURL = $data[0]['img']; 		
		$item = $data[0]['item'];
		$is_added_product = (int)$data[0]['is_added_product'];
		$is_accepted = $data[0]['is_accepted'];
		$weight = $data[0]['weight'];
		$state = 0;
		$product = '';
		echo $rate.' '.$cost.' '.$amount.' '.$applicant.' '.$is_added_product;
		$output = '';
		$count = 0;
		//for assign it to new pro_id for existing product
		$new_pro_id = 0;
		$product = new ProductManager();
		$is_accepted = 0;
		$flag = '';
		/////////////////////////////////////////////////////
		function checkRedundantAddRequest($applicant_type, $applicant_id, $pro_name, $not_id){
				$flag = 'true';
				//search in notification table about add request with the same applicant_id and same pro_name
				$admin = new AdminManager();
				$redundantPro = $admin->selectQuery("SELECT pro_name, applicant_id, applicant FROM notification WHERE applicant = '$applicant' AND applicant_id = '$applicant_id' AND pro_name = '$pro_name' AND not_id<>'$not_id'");
				if($redundantPro!==NULL)
					$flag = 'false';
				return $flag;
			
		}
		
	if($is_added_product==1 && $applicant==='company')//just add product to procomp or proclient
	{
		$flag = checkRedundantAddRequest('company', $applicant_id, $pro_name, $not_id);
		if($flag==='true')
		{
			//first we should check if the company made add request with same product name
			$is_accepted = 1;
			echo $is_accepted;
			$result = $product->addProductToProcomp($applicant_id, $pro_id, $date_of_expose, $amount, $cost, $production_date, $discount_percent, $date_of_modify, $rate, $num_likes, $pro_name, $profit_id, $cur_amount, $num_sell, $col, $size, $selectedImageURL, $aboutproduct, $weight);
			if($result===false){
				$output =  "1";
			}else{
				$output =  "done1";
		}
	}
		//here get the data of product and insert into procomp database
	}if($is_added_product===1 && $applicant==='client'){
		//here get the data of product and insert into proclient database
		
		$flag = checkRedundantAddRequest('client', $applicant_id, $pro_name, $not_id);
		if($flag==='true')
		{
			$is_accepted = 1;
			$result = $product->addProductToProclient($applicant_id, $pro_id, $date_of_expose, $amount, $cost, $production_date, $discount_percent, $date_of_modify, $rate, $num_likes, $pro_name, $profit_id, $cur_amount, $num_sell, $col, $size, $selectedImageURL, $aboutproduct, $weight);
			if($result===false)
				$output = "2";
			else{
				$output = "done2";
		}
	}

	}if($is_added_product===0 && $applicant==='company'){
		//here get the data of product and insert into procomp and product database
		//1.
		
		$flag = checkRedundantAddRequest('company', $applicant_id, $pro_name, $not_id);
		if($flag ==='true'){
			$is_accepted = 1;
			$result = $product->addProductToProduct($pro_name, $item);
			$data = $product->selectQuery("SELECT pro_id FROM product WHERE name = '$pro_name'");
			if($data!==false){
				$new_pro_id = $data[0]['pro_id'];
				$result = $product->addProductToProcomp($applicant_id, $new_pro_id, $date_of_expose, $amount, $cost, $production_date, $discount_percent, $date_of_modify, $rate, $num_likes, $pro_name, $profit_id, $cur_amount, $num_sell, $col, $size , $selectedImageURL, $aboutproduct, $weight);
					if($result===false){
						$output = "3";
					}else{
						$output = "done3";
					}
		}
	}
	}if($is_added_product===0 && $applicant==='client'){
		
		$flag = checkRedundantAddRequest('client', $applicant_id, $pro_name, $not_id);
		if($flag ==='true'){
			$is_accepted = 1;
			$result = $product->addProductToProduct($pro_name, $item);
			$data = $product->selectQuery("SELECT pro_id FROM product WHERE name = '$pro_name'");
			if($data!==false){
				$new_pro_id = $data[0]['pro_id'];
				$result = $product->addProductToProclient($applicant_id, $new_pro_id, $date_of_expose, $amount, $cost, $production_date, $discount_percent, $date_of_modify, $rate, $num_likes, $pro_name, $profit_id, $cur_amount, $num_sell, $col, $size, $selectedImageURL, $aboutproduct, $weight);
					if($result===false){
						$output = "4";
					}else{
						$output = "done4";
					}
		}
	}
		
		//here get the data of product and insert into proclient and product database
	}
	
	if($is_added_product === 1 && $flag = 'true')
		notifyIfInWish($pro_id, $pro_name, $item);
	else if($is_added_product === 0 && $flag = 'true')
		notifyIfInWish($new_pro_id, $pro_name, $item);
	//here send email to client*/
	$result = $admin->updateQuery("UPDATE notification
				SET
				is_procecced = 1,
				is_accepted = '$is_accepted' 
				WHERE not_id = '$not_id';
		");
	if($result!==false)
		echo $output.' '.$flag.' '.$is_accepted;	
	
?>