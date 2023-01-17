<?php
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Admin.php';
	require_once 'AdminManager.php';

	$admin = new AdminManager();
	
	$data = $admin->selectQuery("SELECT * FROM ocaasion");
	$outputString = '';
	$count = 0;
	if($data!==NULL){
		for($i =0; $i<sizeof($data); ++$i){
			$occ_id = $data[$i]['occ_id'];
			$outputString.='<option id="'.$occ_id.'" value="'.$data[$i]['occasion_name'].'">'.$data[$i]['occasion_name'];
			
			
			$outputString.='</option>';
		

	}
	$count = sizeof($data);
	$array = array(
   'event' => $outputString,
   'unseen_notification'  => $count
	);
	 echo  json_encode($array);

	}
	else
		{$outputString = '<option>no ocassion</option>';
		$count = 0;
		$array = array(
   'event' => $outputString,
   'unseen_notification'  => $count
	);
	 echo  json_encode($array);
	}

	
?>