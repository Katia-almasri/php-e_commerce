<?php
	
	class ProductManager extends DBManager{
		function __construct (){
			parent::__construct();
		}
		
		//if there is no data in a table //
		public function getAllProducts(){
			//editing adding and delete should be refresh in procomp and Product
			if($this->checkConnection('product')===true)
			{
				$data = $this->selectQuery("SELECT * FROM product");
				echo ($data);
			}
		
		}
		
		
		
		function addProductToProcomp($com_id, $pro_id, $date_of_expose, $amount, $cost, $production_date, $discount_percent, $date_of_modify, $rate, $num_likes, $pro_name, $profit_id, $cur_amount, $num_sell, $col, $size, $selectedImageURL, $aboutproduct, $weight){
			$data = $this->insertQuery("INSERT INTO procomp (com_id, pro_id, date_of_expose, amount, cost, production_date, discount_percent, date_of_modify, rate, num_likes, pro_name, profit_id, cur_amount, num_sell, col, size,  description, image, state, weight) VALUES(
					'$com_id', '$pro_id', '$date_of_expose', '$amount', '$cost', '$production_date', '$discount_percent', '$date_of_modify', '$rate', '$num_likes', '$pro_name', '$profit_id', '$cur_amount', '$num_sell', '$col', '$size','$aboutproduct', '$selectedImageURL', 0, '$weight');");
				if($data!==false)
					return true;
				
				return false;
			
		}
		
		function addProductToProduct($name, $item){
			if($this->checkConnection("product")===true){
				
				$data = $this->insertQuery("INSERT INTO product (name,item_id) VALUES('$name',  '$item');");
				if($data!==false){
				
				return true;
				}
				return false;
			}
		}

		function addProductToProclient($client_id, $pro_id, $date_of_expose, $amount, $cost, $production_date, $discount_percent, $date_of_modify, $rate, $num_likes, $pro_name, $profit_id, $cur_amount, $num_sell, $col, $size, $selectedImageURL, $aboutproduct, $weight){

			if($this->checkConnection("proclient")===true){
				
				$data = $this->insertQuery("INSERT INTO proclient (client_id, pro_id, date_of_expose, amount, cost, production_date, discount_percent, date_of_modify, rate, num_likes, pro_name, profit_id, cur_amount, num_sell, col, size, image, description, weight, state) VALUES(
					'$client_id', '$pro_id', '$date_of_expose', '$amount', '$cost', '$production_date', '$discount_percent', '$date_of_modify', '$rate', '$num_likes', '$pro_name', '$profit_id', '$cur_amount', '$num_sell', '$col', '$size', '$selectedImageURL', '$aboutproduct', '$weight', 0);");
				if($data!==false)
					return true;
				
				return false;
			}

		}
		
		
		
	}	
 
			
		
		
	
?>