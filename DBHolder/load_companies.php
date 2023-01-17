<?php
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Admin.php';
	require_once 'CompanyManager.php';
	require_once 'AdminManager.php';

	

	$company = new CompanyManager();
	
	$data = $company->selectQuery("SELECT * FROM company");
	$outputString = '';
	$count = 0;
	if($data!==NULL){
		for($i =0; $i<sizeof($data); ++$i){
			$company_id = $data[$i]['com_id'];
			$outputString.='<div id="'.$company_id.'">';
			$outputString.='name: '.$data[$i]['name'].'<br>email: '.$data[$i]['email'].'<br>about company: ';
			$decoded_string = $data[$i]['about_us'];
			$outputString.=$decoded_string.'<br><br>';
			$outputString.='<input type="button" id="'.$company_id. '"value="email" class="email">';
			$outputString.='<input type="button" id="'.$company_id.'"value="delete" class="delete"><br>================================';
			$outputString.='</div>';
			$outputString.='<br><br>';


		}
		$count = sizeof($data);
		$array = array(
   'event' => $outputString,
   'unseen_notification'  => $count
	);
	 echo  json_encode($array);
	}

	
?>