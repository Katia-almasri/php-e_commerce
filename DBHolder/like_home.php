<?php
	
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	require_once 'CompanyManager.php';

	$email = '';
	$psd = '';
	$com_id = '';
	session_start();
	if(isset($_SESSION['psd']))
	{
		
		$email = $_SESSION['email'];
		$psd = $_SESSION['psd'];
		echo $email.' %';
		$com_id = $_SESSION['com_id'];
		
	
	}else{
		echo 'you dont have permission to login this page';
		echo '<a href="login.php">LOGIN </a>';
		exit();
			
	}

	$company = new CompanyManager();
	$procomp = $company->selectQuery("SELECT * FROM procomp WHERE procomp_id = 175");
	$company_info = $company->selectQuery("SELECT name, image FROM company WHERE com_id = '$com_id'");	
	$type_id = $procomp[0]['procomp_id'];
	$image =  $company_info[0]['image'];
	$name =  $company_info[0]['name'];
	echo $type_id;
	
?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>like home(for delete)</title>
		<script src="jquery.js"></script>

	<script type="text/javascript"> 
		$(document).ready(function(){
			$(".send").click(function(event){
				event.preventDefault();
				comment_field = $(".comment_field").val();
				$.ajax({
					type: "POST",
					url: "processComment.php",
					data:{
						name:"<?php echo($company_info[0]['name']);?>", 
						comment_field :comment_field,
						type_product : 'procomp',
						type_id : "<?php echo($procomp[0]['procomp_id']);?>",
						com_id : "<?php echo($com_id);?>",
						image : "<?php echo($company_info[0]['image']);?>"
					},
					success: function(data){
						new_comment = '<div><img src="<?php echo($image);?>"><?php echo($name);?><br>'+comment_field+'<br></div>';
					$("#comments").prepend(new_comment);
					$('.comment_field').val('');
					
				}
			});
		});
	});

	</script>
	</head>
	<body>
		<div id="<?php echo($procomp[0]['procomp_id']);?>">
			<?php echo($procomp[0]['pro_name']);?>
			<?php echo($procomp[0]['procomp_id']);?>
		</div>

		<form id="write_comment">
		<img src="<?php echo($image);?>">
		<?php echo $name;?>"
		<textarea id="<?php echo($com_id);?>" class="comment_field"></textarea>
		<input type="submit" name="send" id="<?php echo($com_id);?>" value="send" class="send">
	</form>
	
		<div id="comments" class="comments">
		<?php
				$company = new CompanyManager();
				
	 				$comments = $company->selectQuery("SELECT procomp_comment.*, 
	 				CASE 
	 				WHEN procomp_comment.write_comment_type = 'client' THEN client.image
	 				WHEN procomp_comment.write_comment_type = 'company'THEN company.image
	 				WHEN procomp_comment.write_comment_type = 'marktech'THEN marktech.image
	 				ELSE NULL
     			    END AS 'comment_image',

     			    CASE 
	 				WHEN procomp_comment.write_comment_type = 'client'THEN client.username
	 				WHEN procomp_comment.write_comment_type = 'company'THEN company.name
	 				WHEN procomp_comment.write_comment_type = 'marktech'THEN 'MARKTECH'
	 				ELSE NULL
     			    END AS 'comment_name'
     			    FROM procomp_comment
     			   
     			    LEFT JOIN client ON procomp_comment.write_comment_id = client.client_id
     			    LEFT JOIN company ON procomp_comment.write_comment_id = company.com_id
     			    LEFT JOIN marktech ON procomp_comment.write_comment_id = marktech.marktech
 				     WHERE procomp_id = '$type_id'");
	 			if($comments!==NULL)  for($i=0;$i<sizeof($comments); $i++)
      			 : ?>
      		<div id="<?=$comments[$i]['comment_id']?>">
      			<div><?=$comments[$i]['date_of_comment']?></div>
      			<img src="<?=$comments[$i]['comment_image']?>">
      			<div><?=$comments[$i]['comment_name']?></div>
      			<div><?=$comments[$i]['comment_text']?></div>
      		</div>
			<?php endfor ?>



	</div>
	
	</body>
	</html>

