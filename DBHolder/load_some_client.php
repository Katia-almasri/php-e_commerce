<?php
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Admin.php';
	require_once 'ClientManager.php';
	require_once 'AdminManager.php';

	
	$cnt = htmlspecialchars($_POST['cnt_clients']);
	$client = new ClientManager();
	
	$data = $client->selectQuery("SELECT * FROM client ORDER BY date_of_login DESC LIMIT $cnt;");
	$outputString = '';
	if($data!==NULL){
		for($i =0; $i<sizeof($data); ++$i){
			$client_id = $data[$i]['client_id'];
			$outputString.='<li id="'.$client_id.'">';
			$outputString.='username: '.$data[$i]['username'].'<br>email: '.$data[$i]['email'].'<br>level: '.$data[$i]['level'].'<br>work: '.$data[$i]['work'].'<br><br>';
			
			
			
			$outputString.='<input type="button" id="'.$client_id. '"value="email" class="email">';
			$outputString.='<input type="button" id="'.$client_id.'"value="delete" class="delete"><br>================================';
			$outputString.='</li>';
			$outputString.='<br><br>';
		}
		
	}else
		$outputString = '<li>no more clients now</li>';
	echo  $outputString;
	
?>