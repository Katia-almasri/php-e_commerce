<?php
	require_once 'DBManager.php';
	class ClientManager extends DBManager{
		
		public function getAllClients(){
			
			if($this->checkConnection('client')===true)
			{	
				$data = $this->selectQuery("SELECT * FROM client");
				if($data!==NULL)
					return $data;
			}else{
				echo NULL;  //new
			}
		}
		
		
			function addClient($username,$gender, $birthdate, $work, $about_you,$location1, $level, $date_of_login, $password, $email, $imgURL,$nu){
				
			//addition to company db
			
			$newClient = new Client($username,$gender, $birthdate, $work, $about_you,$location1, $level, $date_of_login, $password, $email,$nu);
			
				$username = $newClient->getUsername();
				$birthdate = $newClient->getBirthDate();
				$work = $newClient->getWork();
				$about_you = $newClient->getAboutYou();
				$level = $newClient->getLevel();
				$date_of_login = $newClient->getDateOfLogin();
				$password = $newClient->getPassword();
				$email = $newClient->getEmail();
				$location1=$newClient->getLocation1();
				$nu=$newClient->getnu();
			

			if($this->checkConnection("client")===true){
				
				$data = $this->insertQuery("INSERT INTO client(username,gender, birthdate, work, about_you, location, level, date_of_login, password,email, image,nu)
					VALUES('$username','$gender', '$birthdate', '$work', '$about_you','$location1', '$level', '$date_of_login', '$password','$email', '$imgURL','$nu');
				");
				if($data!==NULL){
						return true;
				}
				return false;
			}
			return false;
		}
		



		function getAllProductsBelongToClient($email, $password){    //psd
			
			
			if($this->checkConnection('proclient')===true && $this->checkConnection('client')===true)
			{
				//converting to list of products to give products company

				$data = $this->selectQuery("SELECT  pro.pro_name,pro.pro_id, pro.date_of_expose, pro.amount, pro.cost, pro.production_date, pro.discount_percent, pro.date_of_modify, pro.rate, pro.num_likes, pro.num_sell, pro.image FROM client as cl, proclient as pro  WHERE cl.client_id = pro.client_id AND cl.email ='$email' ");
				if($data!==NULL){

					return ($data);
					
				}
				
				else
					echo NULL;
			}
			
		}
		
					
					
	}
	
?>