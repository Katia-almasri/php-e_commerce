<?php
	require_once 'CompanyManager.php';

	$com_id = htmlspecialchars($_POST['com_id']);

	$company = new CompanyManager();
	$data = $company->deleteQuery("DELETE FROM company WHERE com_id = '$com_id'");
	if($data!==false)
		{
			echo "company deleted successfully";
			//email this client
		}	
		else
			echo "some error happend!!";



?>