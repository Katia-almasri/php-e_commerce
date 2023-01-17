<?php
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	require_once 'ClientManager.php';
	require_once 'auxFunctions.php';  //new 
		
	session_start();
	if(isset($_SESSION['email']))
	{	
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
		

	}
	else{
		echo 'you dont have permission to add product <br> you dont have account';
		exit();
	}
	
		$error_found = '';
		
		$proclient_id =  htmlspecialchars($_POST['proclient_id']);  //original
		$amount = htmlspecialchars($_POST['amount']);
		$cost = htmlspecialchars($_POST['cost']);
		$production_date = htmlspecialchars($_POST['production_date']);
		$image = htmlspecialchars($_POST['image']);
		$rate = htmlspecialchars($_POST['rate']);
		$image = str_replace("<br>", "", $image);

		$date_of_modify =  date('Y-m-d');
		
		if(empty($amount) || empty($cost)){
			$error_found = 'fill in all fields!';
		}else if($amount<0 || $cost<0){
			$error_found = 'true';
		}else{

			if(!empty($production_date)){
				if(checkDateInput($production_date)===false){
					echo 'true';
					return;
				}
			}

			$product = new ProductManager();
			$oldProclient = $product->selectQuery("SELECT * FROM proclient WHERE proclient_id = '$proclient_id'");
			$old_cost = (int)$oldProclient[0]['cost'];
			
			$discount_percent = -((int)$cost-(int)$old_cost)/(int)$old_cost;
			
			$cost = (int)$cost + ($cost*5)/100.0;
			
				$proclientTable = $product->updateQuery("UPDATE proclient SET
						date_of_modify = '$date_of_modify', 
						amount = '$amount', 
						production_date = '$production_date', 
						image = '$image',
						rate = '$rate', 
						cost = '$cost',
						discount_percent = '$discount_percent'
						WHERE proclient_id = '$proclient_id';
					");
				if($proclientTable!==false){
					$array = array(
   					'production_date' => $production_date,
   					'cost'  => $cost,
   					'amount' =>$amount,
   					'rate'=>$rate, 
   					'proclient_id'=>$proclient_id,
   					'image'=>$image,
   					'error'=>$error_found
					);
					echo json_encode($array);
				}else{
					 array(
   					'production_date' => '',
   					'cost'  => 0.00,
   					'amount' =>0,
   					'rate'=>0, 
   					'proclient_id'=>0,
   					'image'=>'',
   					'error'=>$error_found
					);
					echo json_encode($array);
				}
		
		}

		



?>