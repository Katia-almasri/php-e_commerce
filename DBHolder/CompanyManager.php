<?php
	require_once 'DBManager.php';
	class CompanyManager extends DBManager{

		function __construct (){
			parent::__construct();
		}
		
		public function getAllCompanies(){
			
			if($this->checkConnection('company')===true)
			{	
				$data = $this->selectQuery("SELECT * FROM company WHERE com_id>=122");
				if($data!==NULL)
					return ($data);
			}else{
				echo NULL;  //new
			}
		}
		
		function getAllProductsBelongToCompany($email, $psd){    //psd
			
			
			if($this->checkConnection('procomp')===true && $this->checkConnection('company')===true)
			{
				//converting to list of products to give products company

				$data = $this->selectQuery("SELECT  pro.procomp_id, pro.pro_name,pro.pro_id, pro.date_of_expose, pro.amount, pro.cost, pro.production_date, pro.discount_percent, pro.date_of_modify, pro.rate, pro.num_likes, pro.num_sell, pro.description, pro.image FROM company as com, procomp as pro  WHERE com.com_id = pro.com_id AND com.email ='$email' ");
				if($data!==NULL){

					return ($data);
					
				}
				
				else
					echo NULL;
			}
			
		}
		
			function addCompany($name, $branch, $location, $date_launch, $lisence_number, $date_of_login, $owner, $email, $aboutus, $psd, $level, $num_follower, $imgURL){
				
			//addition to company db
			
			$newCompany = new Company($name, $branch,$location, $date_launch, $lisence_number, $date_of_login, $owner, $email, $aboutus, $psd, $level, $num_follower, $imgURL);
			
			$name = $newCompany->getName();
			$location = $newCompany->getLocation();
			$branch = $newCompany->getBranch();
			$date_launch = $newCompany->getDateLaunch();
			$lisence_number = $newCompany->getLisenceNumber();
			$date_of_login = $newCompany->getDateLogin();
			$owner = $newCompany->getOwner();
			$email = $newCompany->getEmail();
			$aboutus = $newCompany->getAboutUs();
			$psd = $newCompany->getPsd();
			$level = $newCompany->getLevel();
			$num_follower = $newCompany->getNumFollower();
			

			if($this->checkConnection("company")===true){
				
				$data = $this->insertQuery("INSERT INTO company(name, branch, location, date_launch, lisence_number, date_of_login, owner, email, about_us, password, num_follower, level, image)
					VALUES('$name','$branch','$location', '$date_launch', '$lisence_number', '$date_of_login', '$owner', '$email', '$aboutus', '$psd', '$num_follower', '$level', '$imgURL');
				");
				if($data!==NULL){
					
					return true;
				}
				return false;
			}
			return false;
		}
		
		
		function getCompanyByName($comName){
			if($this->checkConnection('Company')===true){
				$result = $this->selectQuery("SELECT * FROM Company WHERE name=".$comName);
				return $result;
			}
			return NULL;
			
		}
			
					
	}
	
?>