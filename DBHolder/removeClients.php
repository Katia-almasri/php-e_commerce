<?php
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Admin.php';
	require_once 'ClientManager.php';
	require_once 'AdminManager.php';

	

	$client = new ClientManager();
	
	$data = $client->selectQuery("SELECT * FROM client");
	$outputString = '';
	$count = 0;
	if($data!==NULL){
		for($i =0; $i<sizeof($data); ++$i){
			$outputString.='
			 <div class="container-fluid" id="'. $allClients[$i]['client_id'].'">
                
                <div class="row">
                   
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            
                        <div class="hpanel hblue contact-panel contact-panel-cs responsive-mg-b-30">

                            <div class="panel-body custom-panel-jw">
                                <div class="social-media-in">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                               
                                <img alt="logo" class="img-circle m-b" src="../'.$allClients[$i]['image'].'">
                                <h3><a href="">'.$allClients[$i]['username'].'</a></h3>
                                <p class="all-pro-ad">.'$allClients[$i]['location'].'</p>
                            <div class="courses-alaltic">
                                <span class="cr-ic-r"><span class="course-icon"><i class="fa fa-heart"></i></span> 50</span>
                                <span class="cr-ic-r"><span class="course-icon"><i class="fa fa-dollar"></i></span> 500</span>
                            </div>
                            <div class="course-des">
                                <p><span><i class="fa fa-clock"></i></span> <b>E_mail:</b>'.$allClients[$i]['email'].'</p>
                                <p><span><i class="fa fa-clock"></i></span> <b>Job:</b>'.$allClients[$i]['work'].'</p>
                                <p><span><i class="fa fa-clock"></i></span> <b>Level:</b>';
                                 if($allClients[$i]['level']==0)
                                 	$outputString.='normal';
                                 else 
                                 	$outputString.='vip';
                                 $outputString.='</p>';
                                 $outputString.='
                            </div>
                            </div>
                            <div class="panel-footer contact-footer">
                                <div class="professor-stds-int">
                                    <button data-toggle="tooltip" title="Email" class="pd-setting-ed-email" id="'.$allClients[$i]['client_id'].'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                    &nbsp;
                                    <button data-toggle="tooltip" title="Delete" class="pd-setting-ed-delete" id="'. $allClients[$i]['client_id'].'" name="'.$pro[$i]['type'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                </div>

                            </div>

                        </div>

                    </div>
                  
                                       

                   </div>

               </div>';


		}
		$count = sizeof($data);
		$array = array(
   'event' => $outputString,
   'unseen_notification'  => $count
	);
	 echo  json_encode($array);
	}else{
		$array = array(
   'event' => 'no new clients',
   'unseen_notification'  => 0
	);
	 echo  json_encode($array);
	}

	
?>