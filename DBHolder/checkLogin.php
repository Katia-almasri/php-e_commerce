<?php
	require 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Company.php';
	require 'CompanyManager.php';
	
		function checkValidationString($submittedItem){
		if(is_numeric($submittedItem))
			return false;
		return true;
		
	}
	
	function checkNameExist($inputName){
		
		$company = new CompanyManager();
		$data = $company->selectQuery("SELECT * FROM Company WHERE name='$inputName'", "Company");
		if($data!==NULL)
			return true;
		return false;
	}
	
	$name = htmlspecialchars($_POST['name']);
	if(empty($name))
		echo 'fill all fields!';
	else{
		if(checkNameExist($name)===false){
			
			echo 'Wrong name';
			exit;
		}else{
			
			//show  comany dashboard by id
				//1.fetch id company
				$company = new CompanyManager();
				$data = $company->selectQuery("SELECT id FROM Company WHERE name='$name'", "Comapny");
				if($data!==NULL){
					$com_id = $data[0]['id'];
					//2.redirect to ajaxtest1 by com_id
					
					echo $com_id;
				}
			//load ajaxtest1 by name of company
			
		}
		
	}

?>