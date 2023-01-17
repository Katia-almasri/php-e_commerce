<?php
	require_once 'DBManager.php';
	class AdminManager extends DBManager{
		function __construct (){
			parent::__construct();
		}

		public function getAllNotification(){
			$data = $this->selectQuery("SELECT * FROM notification ");
			if($data!==NULL)
				return $data;
			return NULL;
		}

		public function addNotification($not_type, $applicant, $date_of_not, $applicant_id, $applicant_name, $img,$is_added_product, $item, $amount, $cost, $production_date, $rate, $pro_name, $col, $size, $description, $pro_id, $weight){
			$data = $this->insertQuery("INSERT INTO notification(not_type, is_accepted, applicant, date_of_not, applicant_id, applicant_name, img, is_added_product, item, amount, cost, production_date, rate, pro_name, col, size, description, pro_id, weight)VALUES('$not_type', 0, '$applicant', '$date_of_not', '$applicant_id', '$applicant_name', '$img','$is_added_product' , '$item', '$amount', '$cost', '$production_date', '$rate', '$pro_name', '$col', '$size', '$description', 'pro_id', '$weight');");
			if($data!==NULL){
					
					return true;
				}
				return false;
			}
		
		}
		
	







?>