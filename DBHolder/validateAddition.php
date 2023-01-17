<?php
require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
require_once 'ProductManager.php';
require_once 'CompanyManager.php';
require_once 'AdminManager.php';
require_once 'auxFunctions.php';
	
	$email = '';
	$psd = '';
	$com_id = 0;
	session_start();
	if(isset($_SESSION['com_id'])){
		
		$email = $_SESSION['email'];
		$psd = $_SESSION['psd'];
		$com_id = $_SESSION['com_id'];
	}else{
		
		echo 'you dont have perimission to login this page';
		exit;
	}

	
		//fetching data from user
		
		$pro_name = htmlspecialchars($_POST['name']);
		$item = htmlspecialchars($_POST['item']);
		$amount = htmlspecialchars($_POST['amount']);
		$cost = htmlspecialchars($_POST['cost']);
		$production_date =  htmlspecialchars($_POST['production_date']); 
		$date_of_expose = date('Y-m-d');
		$date_of_modify = date('Y-m-d');
		$rate = htmlspecialchars($_POST['rate']);
		$selectedImageURL = htmlspecialchars($_POST['selectedImageURL']);
		$aboutproduct = htmlspecialchars($_POST['aboutproduct']);
		$weight = htmlspecialchars($_POST['weight']);
		$num_likes = 0;
		$cur_amount = $amount;
		$profit_id = 1;
		$num_sell = 0;
		$col = 1;
		$size='S';
		$discount_percent = 0;
		$error_found = 'false';
		/////////////////////
		$pro_id = 0;
		$com_name = '';
		
		///////////////////////////////////////////////////////////////////

		function checkRedundantProduct($com_id, $pro_name){
		$product = new ProductManager();
		$output = '';
		$is_redundant_product = $product->selectQuery("SELECT pro_name, com_id, procomp_id FROM procomp WHERE pro_name = '$pro_name' AND com_id = '$com_id'");
			if($is_redundant_product!==NULL){
			   //if this company had inserted product with the same name:
			$output = '<div id="msg">There is already product in this name in your product list <br>';
			$output.='<input type="submit" id="'.$is_redundant_product[0]['procomp_id'].'" value="replace" class="replace">';
			$output.='<input type="submit" id="'.$is_redundant_product[0]['procomp_id'].'" value="cancel" class="cancel"></div>';


			}else{
				$output = '';
			}
			return $output;
	}



		if(empty($pro_name) || empty($amount) || empty($cost)||empty($weight)){
			 $error_found = 'fill in all fields<br>';
		}else if($amount <0 || $cost <=0 ){
			$error_found = 'invalid numbers<br>';
		}else{
			
			if(!empty($production_date)){
				if(checkDateInput($production_date)===false){
					echo 'wrong date';
					return;
				}
			}

				$product = new ProductManager();
				$pro_feature = $product->selectQuery("SELECT name, pro_id FROM product WHERE name ='$pro_name' AND item_id = '$item'");
				$com_feature = $product->selectQuery("SELECT com_id, name FROM company WHERE email ='$email'");
				if($pro_feature!==NULL){               //new for admin
						$pro_id = (int)$pro_feature[0]['pro_id'];
						$com_id = (int)$com_feature[0]['com_id'];
						$com_name = $com_feature[0]['name'];
						echo $com_name;
						//add notification
						$admin = new AdminManager();
						//if this company added same product name in the past(replace or cancel):
						$redundant_pro = checkRedundantProduct($com_id, $pro_name);
						if($redundant_pro!=='')
							$error_found = $redundant_pro;
						else
						{
							$date_of_not = date('Y-m-d');
							$data = $admin->addNotification('add request', 'company', $date_of_not, $com_id, $com_name, $selectedImageURL, 1, $item, $amount, $cost, $production_date, $rate, $pro_name, $col, $size, $aboutproduct, $pro_id, $weight);
						
							if($data===false)
							$error_found = 'false';

						
					}
				}else{
					$admin = new AdminManager();
					$pro_id = 0;
					echo $com_id.' '.$pro_name;
					$date_of_not = date('Y-m-d');
					$com_name = $com_feature[0]['name'];
					$data = $admin->addNotification('add request', 'company', $date_of_not, $com_id, $com_name, $selectedImageURL, 0, $item, $amount, $cost, $production_date, $rate, $pro_name, $col, $size, $aboutproduct, $pro_id, $weight);
						
					if($data===false)
							$error_found = 'false';
					//$addToProduct = $product->addProductToProduct($pro_name, $item);
					/*if($addToProduct!==false)
					{
						
						$pro_feature = $product->selectQuery("SELECT name, pro_id FROM product WHERE name ='$pro_name'");
				$com_feature = $product->selectQuery("SELECT com_id FROM company WHERE email ='$email'");
				if($pro_feature!==NULL && $com_feature!==NULL){
					//new for admin
						$pro_id = $pro_feature[0]['pro_id'];
						$com_id = $com_feature[0]['com_id'];
						/*$data = $product->addProductToProcomp($com_id, $pro_id, $date_of_expose, $amount, $cost, $production_date, $discount_percent, $date_of_modify, $rate, $num_likes, $pro_name, $profit_id, $cur_amount, $num_sell, $col, $size, $selectedImageURL, $aboutproduct);
						if($data===false){
							$error_found = 'some error happened!!';
						}*/
						//add notification
						/*$not_text = 'date of expose: '.$date_of_expose.'<br>amount: '.$amont.'<br>cost: '.$cost.'<br>production date: '.$production_date.'<br>discount percent: '.$discount_percent.'<br>date of modify: '.$date_of_modify.'<br>rate: '.$rate.'<br>ptoduction nam: '.$pro_name.'<br>color: '.$col.'<br>size: '.$size.'<br>about product: '.$aboutproduct.'<br>';
						$date_of_not = date('Y-m-d');
						$data = $admin->
						addNotification('add request', $not_text, 'company', $date_of_not, $com_id, $com_name, $selectedImageURL, 0);
						if($data===false)
							$error_found = 'we encountered some error!!';
							

					}
				}*/
			}
		}

		echo $error_found;
?>
