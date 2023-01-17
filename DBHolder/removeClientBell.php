<?php
  require_once 'ClientManager.php';
  require_once 'ProductManager.php';
  $client = new ClientManager();
  $client_id = htmlspecialchars($_POST['client_id']);
  $output = '';
  $count = 0;

      $sql1 = $client->selectQuery("SELECT * from client_bell where is_seen = 0 AND client_id='$client_id'");
      if($sql1!==NULL)
      {
         for($i = 0; $i<sizeof($sql1); ++$i){
          $bell_id = $sql1[$i]['bell_id'];
        $output.='<li id="$bell_id">';
        $output.='Subject: '.$sql1[$i]['subject'].'<br>'.$sql1[$i]['bell_text'].'<br></li>';
      

    }
    $count = sizeof($sql1);
    $data = array(
   'bell' => $output,
   'unseen_notification'  => $count
);
      echo json_encode($data);
    
  }
    else{
      $data = array(
   'bell' => '<li>no new notification</li>',
   'unseen_notification'  => 0
);
      echo json_encode($data);
    }

     


       
  ?>