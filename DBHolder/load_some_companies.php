<?php
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Admin.php';
	require_once 'CompanyManager.php';
	require_once 'AdminManager.php';

	
	$cnt = htmlspecialchars($_POST['cnt_companies']);
	$company = new CompanyManager();
	
	$data = $company->selectQuery("SELECT * FROM company ORDER BY date_of_login DESC LIMIT $cnt;");
	$outputString = '';
	if($data!==NULL){
		for($i =0; $i<sizeof($data); ++$i){
			$company_id = $data[$i]['com_id'];
			$outputString.='<li id="'.$company_id.'">';
			$outputString.='name: '.$data[$i]['name'].'<br>email: '.$data[$i]['email'].'<br>about company: ';
			$decoded_string = $data[$i]['about_us'];
			$outputString.=$decoded_string.'<br><br>';
			$outputString.='<input type="button" id="'.$company_id. '"value="email" class="email">';
			$outputString.='<input type="button" id="'.$company_id.'"value="delete" class="delete"><br>================================';
			$outputString.='</li>';
			$outputString.='<br><br>';
		}
		
	}else
		$outputString = '<li>no more companies now</li>';
	echo  $outputString;
	
?>