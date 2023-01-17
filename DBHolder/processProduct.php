<?php
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	require_once 'CompanyManager.php';
	require_once 'auxFunctions.php';  //new 
		
	session_start();
	if(isset($_SESSION['email']))
	{	
		$email = $_SESSION['email'];
		$psd = $_SESSION['psd'];
		

	}
	else{
		echo 'you dont have permission to add product <br> you dont have account';
		exit();
	}

		$error_found = '';
		
		$procomp_id =  htmlspecialchars($_POST['procomp_id']);  //original
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
			$oldProcomp = $product->selectQuery("SELECT * FROM procomp WHERE procomp_id = '$procomp_id'");
			$old_cost = (int)$oldProcomp[0]['cost'];
			
			$discount_percent = -((int)$cost-(int)$old_cost)/(int)$old_cost;
			
			$cost = (int)$cost + ($cost*5)/100.0;
			
				$procompTable = $product->updateQuery("UPDATE procomp SET
						date_of_modify = '$date_of_modify', 
						amount = '$amount', 
						production_date = '$production_date', 
						image = '$image',
						rate = '$rate', 
						cost = '$cost',
						discount_percent = '$discount_percent'
						WHERE procomp_id = '$procomp_id';
					");
				if($procompTable!==false){
					$array = array(
   					'production_date' => $production_date,
   					'cost'  => $cost,
   					'amount' =>$amount,
   					'rate'=>$rate, 
   					'procomp_id'=>$procomp_id,
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
   					'procomp_id'=>0,
   					'image'=>'',
   					'error'=>$error_found
					);
					echo json_encode($array);
				}
		
		}

		



?>