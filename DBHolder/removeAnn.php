<?php
	require_once 'AdminManager.php';
	require_once 'ProductManager.php';

	$admin = new AdminManager();

		$output = '';
		$count = 0;

    function getTypeINFO($type_id, $company_id){
      $output = '';
      $company = new AdminManager();
    
        $com_info = $company->selectQuery("SELECT * FROM company WHERE com_id = '$company_id'");
        if($com_info!==NULL)
          {
            $output.='name: '.$com_info[0]['name'].'<br>email: '.
              $com_info[0]['email'].'<br><img src="'. $com_info[0]['image'].'" id="img" width="100" height="100" class="des-Img">';
          }
     

      return $output;
    }

      $sql1 = $admin->selectQuery("SELECT * FROM  announcement_orders WHERE is_processed = 0");
      if($sql1!==NULL)
      {
      	
      	 for($i = 0; $i<sizeof($sql1); ++$i){
      	  $a_o_id = $sql1[$i]['a_o_id'];
          $output .= '<li id="'.$sql1[$i]['a_o_id'].'">
        <a href="#">
        <div class="notification-content">
        <span class="order-date">'.$sql1[$i]['date_of_order'].'</span>
        <h2>
          Start of advertise:'.$sql1[$i]['start_of_ann'].'
        </h2>
        <img src="../'.$sql1[$i]['image'].'" alt="" class="thumb-lg rounded-circle" width="100"><br>';
        getTypeINFO($sql1[$i]['type_id'], 'company');
        $output.='
        <p>
          Duration of ad:';

          $duration = $sql1[$i]['duration'];
          if($duration==='day')
          echo 'for one day';
          else if($duration==='month')
            echo 'for one month';
          else if($duration==='week')
            echo 'for one week';
          else
            echo 'for one year';

        $output.=' 
      </p>
        <button type="button" class="btn btn-primary launch_announcement" id="'.$sql1[$i]['a_o_id'].'">Accept</button><button type="button" class="btn btn-danger reject_announcement" id="'.$sql1[$i]['a_o_id'].'">Refuse</button>
         </div>
        </a>
         </li>';
		  

		}
		$count = sizeof($sql1);
		$data = array(
   'ann' => $output,
   'unseen_ann'  => $count
);
  		echo json_encode($data);
		//$result = $admin->updateQuery("UPDATE notification SET is_accepted = 1 WHERE is_accepted = 0");

  }
  	else{
  		$data = array(
   'ann' => '<li>no new announcment orders</li>',
   'unseen_ann'  => 0
);
  		echo json_encode($data);
  	}

     


       
  ?>