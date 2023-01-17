<?php
	require_once 'AdminManager.php';
	require_once 'ProductManager.php';
	$admin = new AdminManager();

		$output = '';
		$count = 0;

      $sql1 = $admin->selectQuery("SELECT * from notification where is_procecced = 0");
      if($sql1!==NULL)
      {
      	$count1 = sizeof($sql1);
      	
      	 for($i = 0; $i<sizeof($sql1); ++$i){
      	 	$not_id = $sql1[$i]['not_id'];
		  	$output .= '<li id="'.$sql1[$i]['not_id'].'">
        <a href="#">
         <div class="notification-content">
         <span class="notification-date">'.$sql1[$i]['date_of_not'].'</span>
         <h2>'.$sql1[$i]['not_type'].'</h2>
          <p>product name:'. $sql1[$i]['pro_name'].'<br>
          applicant name: '.$sql1[$i]['applicant'].'<br>
          applicant name:'.$sql1[$i]['applicant_name'].'<br>
          amount: '. $sql1[$i]['amount'].'<br>cost:'.$sql1[$i]['cost'].'<br>
          <img src="../'. $sql1[$i]['img'].'" alt="" class="thumb-lg rounded-circle" width="150"><br>
          Description:'. $sql1[$i]['description'].'
          </p>
          <button type="button" class="btn btn-primary accept" id="'.$sql1[$i]['not_id'].'">Accept</button><button type="button" class="btn btn-danger refuse" id="'.$sql1[$i]['not_id'].'">Refuse</button>
          </div>
          </a>
          </li>';
		  

		}
		$count = sizeof($sql1);
		$data = array(
   'event' => $output,
   'unseen_notification'  => $count
);
  		echo json_encode($data);
		
  }
  	else{
  		$data = array(
   'event' => '<li>no new notification</li>',
   'unseen_notification'  => 0
);
  		echo json_encode($data);
  	}

     


       
  ?>