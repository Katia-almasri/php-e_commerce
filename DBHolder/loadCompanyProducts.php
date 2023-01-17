
<?php

	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	require_once 'CompanyManager.php';

	$company = new CompanyManager();

	$com_id = htmlspecialchars($_POST['com_id']);

	$data = $company->selectQuery("SELECT * FROM procomp  WHERE com_id = '$com_id' ORDER BY date_of_expose DESC");
	$outputString = '';
	if($data!==NULL){
		for($i =0; $i<sizeof($data); ++$i){
			$procomp_id = $data[$i]['procomp_id'];
			$img = $data[$i]['image'];
	 		preg_replace( "/\r|\n/", "", $img);
			$outputString.='<div id="'.$procomp_id.'">';
			$outputString.="<img src='$img' id='img_pro' width='100' height='100' class='des-Img'>";
			$outputString.='product name: '.$data[$i]['pro_name'].'<br>date of production: '.$data[$i]['production_date'].'<br>date of expose: '.$data[$i]['date_of_expose'].'<br>amount: '.$data[$i]['amount'].'<br>cost: '.$data[$i]['cost'].'<br><br>';
			$outputString.='<input type="button" id="'.$procomp_id. '"value="edit" class="edit_pro">';
			$outputString.='<input type="button" id="'.$procomp_id. '"value="remove" class="remove_pro">';
			$outputString.='</div><br>';
		}
		
	}else
		$outputString = '<div>you dont have products </div>';
	echo  $outputString;





?>