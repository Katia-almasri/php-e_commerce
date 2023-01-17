<?php
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Admin.php';
	
	require_once 'AdminManager.php';

	$cnt = htmlspecialchars($_POST['cnt_not']);

	$admin = new AdminManager();
	
	$data = $admin->selectQuery("SELECT * FROM notification WHERE is_accepted = 0 LIMIT $cnt;");
	$outputString = '';
	if($data!==NULL){
		for($i =0; $i<sizeof($data); ++$i){
			$not_id = $data[$i]['not_id'];
			$outputString.='<div id="'.$not_id.'">';
			$outputString.='notification type: '.$data[$i]['not_type'].'<br>applicant: '.$data[$i]['applicant'].'<br>applicant name: '.$data[$i]['applicant_name'].'<br>product name: '.$data[$i]['pro_name'].'<br>item: '.$data[$i]['item'].'<br>amount: '.$data[$i]['amount'].'<br>cost: '.$data[$i]['cost'].'<br>production date: '.$data[$i]['production_date'].'<br>rate: '.$data[$i]['rate'].'<br>description : '.$data[$i]['description'].'<br>';
			
			
			
			$outputString.='<input type="button" id="'.$not_id. '"value="accept" class="accept">';
			$outputString.='<input type="button" id="'.$not_id.'"value="refuse" class="refuse"><br>================================';
			$outputString.='</div>';
			$outputString.='<br><br>';
		}
		
	}
	echo  $outputString;
	
?>