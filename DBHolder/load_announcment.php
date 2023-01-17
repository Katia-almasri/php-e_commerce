<?php
	require_once 'AdminManager.php';
	require_once 'ProductManager.php';

		
		
		

	  function getTypeINFO($type_id, $type){
	  	$output = '';
	  	$company = new AdminManager();
	  	if($type==='company'){
	  		$com_info = $company->selectQuery("SELECT * FROM company WHERE com_id = '$type_id'");
	  		if($com_info!==NULL)
	  			{
	  				$output.='name: '.$com_info[0]['name'].'<br>email: '.
	  					$com_info[0]['email'].'<br><img src="'. $com_info[0]['image'].'" id="img" width="100" height="100" class="des-Img">';
	  			}
	  	}else if($type==='client'){
	  		$client_info = $company->selectQuery("SELECT * FROM client WHERE client_id = '$type_id'");
	  		if($client_info!==NULL)
	  			{
	  				$output.='username: '.$client_info[0]['username'].'<br>email: '.
	  					$client_info[0]['email'].'<br><img src="'. $client_info[0]['image'].'" id="img" width="100" height="100" class="des-Img">';
	  			}
	  	}

	  	return $output;
	  }


	  $output = '';
	  $count = 0;

	  $admin = new AdminManager();
      $sql1 = $admin->selectQuery("SELECT * FROM announcement_orders WHERE is_processed = 0");
      if($sql1!==NULL)
      {
      	
      	 for($i = 0; $i<sizeof($sql1); ++$i){
      	 	$a_o_id = $sql1[$i]['a_o_id'];
      	 	$type = $sql1[$i]['type'];
		  	$output .= '<li id="'.$a_o_id.'">';
		  	$output.='applicant type: '.$sql1[$i]['type'].'<br>';
		  	$type_info = getTypeINFO($sql1[$i]['type_id'], $type);
		  		
		  	$output.=$type_info;
		  	$output.='<br>start of announment: '.$sql1[$i]['start_of_ann'].'<br>date: '.$sql1[$i]['date_of_order'].'<br>';
		  	$output.='<br></li>';
		 

		}
		$count = sizeof($sql1);
		$array = array(
   'ann' => $output,
   'unseen_ann'  => $count
	);
	 echo  json_encode($array);
	 
  }else{
  	$array = array(
   'ann' => '<li>no new announcement orders</li>',
   'unseen_ann'  => 0
);

  	echo json_encode($array);
  }
  	

  	

	
	
     


       
  ?>