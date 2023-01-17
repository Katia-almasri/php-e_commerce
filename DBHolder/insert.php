<?php
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Admin.php';
	require_once 'CompanyManager.php';
	require_once 'ClientManager.php';
	require_once 'AdminManager.php';

	$comment = htmlspecialchars($_POST['comment']);
	echo $comment;
	
		echo "string1";
		$admin = new AdminManager();
		$result = $admin->insertQuery("INSERT INTO event(event_text, event_state) VALUES('$comment', 0);");
		if($result!==false)
			echo "Done!!";
		else{
			echo "string";
		}


?>