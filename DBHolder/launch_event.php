<?php
	
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Admin.php';
	require_once 'CompanyManager.php';
	require_once 'ClientManager.php';
	require_once 'AdminManager.php';

	function sendNotification($type){
		$admin = new AdminManager();
		$subject = 'New event and sales had been launched !';
		$bell_text = 'MARCKTECH launched new event and sales starts at';
		if($type ==='company'){
			$company = $admin->selectQuery("SELECT com_id FROM company");
			if($company!==NULL){
				for($i = 0; $i<sizeof($company); $i++){
					$com_id = $company[$i]['com_id'];
					$result = $admin->insertQuery("INSERT INTO company_bell(com_id, subject, bell_text) VALUES('$com_id', '$subject', '$bell_text');");
					if($result!==false)
						echo "done company";
				}
			}
		}else if($type ==='client'){
			$client = $admin->selectQuery("SELECT client_id FROM client");
			if($client!==NULL){
				for($i = 0; $i<sizeof($client); $i++){
					$client_id = $client[$i]['client_id'];
					$result = $admin->insertQuery("INSERT INTO client_bell(client_id, subject, bell_text) VALUES('$client_id', '$subject', '$bell_text');");
					if($result!==false)
						echo "done client";
				}
			}
		}
		
	}


	

	$email = '';
	$password = '';

	session_start();
	if(isset($_SESSION['email']))
	{
		
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
		
	}else{
		echo 'you dont have permission to login this page';
		echo '<a href="login.php">LOGIN </a>';
		exit();
			
	}


	$array = $_POST['a'];
	$types = $_POST['t'];
	$discountPro = $_POST['discountPro'];
	$discountCom = $_POST['discountCom'];
	$discountCl = $_POST['discountCl'];
	$selectionState = $_POST['selectionState'];
	$st_date = $_POST['st_date'];
	$ed_date = $_POST['ed_date'];
	$selectedEvent = $_POST['selectedEvent'];
	
	$admin = new AdminManager();
	print_r($array);
	print_r($types);
	echo gettype($types);
	echo 'discount product: '.$discountPro.'<br>';
	echo 'discount com: '.$discountCom.'<br>';
	echo 'discount cl: '.$discountCl.'<br>';
	echo 'select state: '.$selectionState.'<br>';
	echo 'select event: '.$selectedEvent.'<br>';
	echo 'st_date: '.$st_date.'<br>';
	echo 'ed_date: '.$ed_date.'<br>';
	if(!empty($discountPro)){
		echo "ss";
		//insert into product discount table and insert event into event table
			$type = 'client';
			$event =  $admin->insertQuery("INSERT INTO event(st_date, ed_date, type, discount, occasion_id) VALUES('$st_date', '$ed_date', '$type', '$discountPro', '$selectedEvent');");
			if(empty($types))
				{
					echo "DONNNNEEEEE::-)";
					$result = $admin->selectQuery("SELECT event_id FROM event WHERE st_date = '$st_date' AND ed_date = '$ed_date' AND occasion_id = '$selectedEvent'");
					if($result!==NULL){
						for($i=0; $i<sizeof($array); $i++){
						$event_id = $result[0]['event_id'];
						$pro = $array[$i];
						//insert product into discount product table
						$result2 = $admin->insertQuery("INSERT INTO discount_product(event_id, pro_id) VALUES('$event_id', '$pro');");
						sendNotification('client');
					}

					}
				}
	
			else
				echo "problem!";
	
	}else if(!empty($types))
		{
			echo "HERE YEAD";
			$type = '';
			$disounct = 0;
			for($i=0; $i<sizeof($types); $i++){
				$type = $types[$i];
				if($type==='company')
					$result = $admin->insertQuery("INSERT INTO event(st_date, ed_date, type, discount, occasion_id) VALUES('$st_date', '$ed_date','company', '$discountCom', '$selectedEvent');");
				else if($type==='client')
					$result = $admin->insertQuery("INSERT INTO event(st_date, ed_date, type, discount, occasion_id) VALUES('$st_date', '$ed_date','client', '$discountCl', '$selectedEvent');");
				if($result!==false)
				{
					sendNotification($type);
			}
				else
					echo "not again";
			}
			//insert new event into event table
		}
	

?>

