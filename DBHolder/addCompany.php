<?php
		require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Company.php';
		require_once 'CompanyManager.php';
		require_once 'auxFunctions.php';
		
	
	
	
	$outputString='';
	
		$name = htmlspecialchars($_POST['name']);
		$branch = htmlspecialchars($_POST['branch']);
		$location = htmlspecialchars($_POST['comp_location']);
		$date_launch = htmlspecialchars($_POST['date_launch']);
		$lisence_number = htmlspecialchars($_POST['lisence_number']);
		$owner = htmlspecialchars($_POST['owner']);
		$email = htmlspecialchars($_POST['email']);
		$aboutus = htmlspecialchars($_POST['aboutus']);
		$imgURL = htmlspecialchars($_POST['imgURL']);
		$psd = htmlspecialchars($_POST['psd']);
		$date_of_login = date('Y-m-d');
		$level = 0;
		$num_follower = 0;
				
		if(!empty($name)  && !empty($email)  &&  !empty($psd)&& !empty($location) ){
			
			//check validation..
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$outputString.= '<div class="row justify-content-center">
        						<div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
           							 <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
							<fieldset>
                        <div class="form-card">
                            <div class="row">
                               
                                
                            </div> <br><br>
                            <h2 class="purple-text text-center"><strong>Invalid email !</strong></h2> <br>
                            <div class="row justify-content-center">
                                 <br><br>
                            
                        </div>
                    </fieldset>

                    </div></div></div>';
				
			}else{
				$company = new CompanyManager();
				if($company->checkConnection('company')===true)
				{
				
					 	if(!empty($birthdate))
						{
					
					 	if (checkDateInput($birthdate)===false) {
						$outputString = '
						<div class="row justify-content-center">
        						<div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
           							 <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
							<fieldset>
                        <div class="form-card">
                            <div class="row">
                               
                                
                            </div> <br><br>
                            <h2 class="purple-text text-center"><strong>invalid date!</strong></h2> <br>
                            <div class="row justify-content-center">
                                 <br><br>
                            
                        </div>
                    </fieldset>

                    </div></div></div>
						';
						}
					}
						$data = $company->selectQuery("SELECT client.client_id, company.com_id FROM client, company WHERE client.email='$email' OR company.email = '$email'");
						if($data!==NULL){
						$outputString = '
						<div class="row justify-content-center">
        						<div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
           							 <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
							<fieldset>
                        <div class="form-card">
                            <div class="row">
                               
                                
                            </div> <br><br>
                            <h2 class="purple-text text-center"><strong>there is alredy account with this email!</strong></h2> <br>
                            <div class="row justify-content-center">
                                 <br><br>
                            
                        </div>
                    </fieldset>

                    </div></div></div>
						';
						
					    }else{
					    	$data = $company->addCompany($name, $branch, $location, $date_launch, $lisence_number, $date_of_login, $owner, $email, $aboutus, $psd, $level, $num_follower, $imgURL);
							if($data!==false)
								$outputString='
							<div class="row justify-content-center">
        						<div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
           							 <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
							<fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Finish:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 4 - 4</h2>
                                </div>
                            </div> <br><br>
                            <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                            <div class="row justify-content-center">
                                <div class="col-3"> <a href="product.htm" style="font-size: 100px"><i class="fas fa-check-circle"></i></a></div>
                            </div> <br><br>
                            <div class="row justify-content-center">
                                <div class="col-7 text-center">
                                    <h5 class="purple-text text-center">You Have Successfully Signed Up</h5>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    </div></div></div>';
							else
								$outputString = '
							<div class="row justify-content-center">
        						<div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
           							 <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
							<fieldset>
                        <div class="form-card">
                            <div class="row">
                               
                                
                            </div> <br><br>
                            <h2 class="purple-text text-center"><strong>there there were som errors!</strong></h2> <br>
                            <div class="row justify-content-center">
                                 <br><br>
                            
                        </div>
                    </fieldset>

                    </div></div></div>
							';
					    }
						
				}

			}

		}else{
			$outputString = '
			<div class="row justify-content-center">
        						<div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
           							 <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
							<fieldset>
                        <div class="form-card">
                            <div class="row">
                               
                                
                            </div> <br><br>
                            <h2 class="purple-text text-center"><strong>fill in all required fields!</strong></h2> <br>
                            <div class="row justify-content-center">
                                 <br><br>
                            
                        </div>
                    </fieldset>

                    </div></div></div>
			';
		}
			
			
		session_start();
		$_SESSION['email'] = $email;
		$_SESSION['psd'] = $psd;
		//echo $_SESSION['email'];
		echo $outputString;
?>