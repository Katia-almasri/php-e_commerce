<?php
	
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	require_once 'CompanyManager.php';
	//
	$com_id = '';
	$psd = '';
	$email = '';
	$name = '';
	$image = '';
	$type_product = '';
	$type_id = '';

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

	$name = htmlspecialchars($_POST['name']);
	$comment_field = htmlspecialchars($_POST['comment_field']);
	$type_product = htmlspecialchars($_POST['type_product']);
	$type_id = htmlspecialchars($_POST['type_id']);
	$image = htmlspecialchars($_POST['image']);
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>product page (test) for delete</title>
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
						name:"<?php echo($name);?>", 
						comment_field :comment_field,
						type_product = "<?php echo($type_product);?>",
						type_id = "<?php echo($procomp_id);?>",
						com_id = "<?php echo($com_id);?>"
					},
					success: function(data){
						new_comment = '<div><img src="<?php echo($image);?>$name"><br>comment_field<br>';
					$("#comments").repend(new_comment);
					
				}
			});
		});
	});

	</script>
</head>
<body>

	<div id="comments" class="comments">
		<?php
				$company = new CompanyManager();
				if($type_product==='procomp')
	 				{$comments = $company->selectQuery("SELECT procomp_comment.*, 
	 				CASE 
	 				WHEN procomp_comment.write_comment_type = 'client'THEN client.image
	 				WHEN procomp_comment.write_comment_type = 'company'THEN company.image
	 				WHEN procomp_comment.write_comment_type = 'marktech'THEN marktech.image
	 				ELSE NULL
     			    END AS comment_image,

     			    CASE 
	 				WHEN procomp_comment.write_comment_type = 'client'THEN client.username
	 				WHEN procomp_comment.write_comment_type = 'company'THEN company.name
	 				WHEN procomp_comment.write_comment_type = 'marktech'THEN 'MARKTECH'
	 				ELSE NULL
     			    END AS comment_name

     			    FROM procomp_comment
     			    LEFT JOIN client ON procomp_comment.write_comment_id = client.client_id
     			    LEFT JOIN company ON procomp_comment.write_comment_id = company.company_id
     			    LEFT JOIN marktech ON procomp_comment.write_comment_id = marktech.marktech
 				    FROM procomp_comment WHERE procomp_id = '$type_id'");


	 			if($comments!==NULL)  for($i=0;$i<sizeof($comments); $i++)
      			 : ?>
      		<div id="<?=$comments[$i]['comment_id']?>">
      			<img src="<?=$comments[$i]['comment_image']?>">
      			<?=$comments[$i]['comment_name']?>
      			<?=$comments[$i]['comment_text']?>
			</div>
			<?php endfor} ?>

			<?php 
				else if ($type_product==='proclient')
				{$comments = $company->selectQuery("SELECT proclient_comment.*, 
	 				CASE 
	 				WHEN proclient_comment.write_comment_type = 'client'THEN client.image
	 				WHEN proclient_comment.write_comment_type = 'company'THEN company.image
	 				WHEN proclient_comment.write_comment_type = 'marktech'THEN marktech.image
	 				ELSE NULL
     			    END AS comment_image,

     			    CASE 
	 				WHEN proclient_comment.write_comment_type = 'client'THEN client.username
	 				WHEN proclient_comment.write_comment_type = 'company'THEN company.name
	 				WHEN proclient_comment.write_comment_type = 'marktech'THEN 'MARKTECH'
	 				ELSE NULL
     			    END AS comment_name

     			    FROM proclient_comment
     			    LEFT JOIN client ON proclient_comment.write_comment_id = client.client_id
     			    LEFT JOIN company ON proclient_comment.write_comment_id = company.company_id
     			    LEFT JOIN marktech ON proclient_comment.write_comment_id = marktech.marktech
 				    FROM proclient_comment WHERE proclient_id = '$type_id'");


	 			if($comments!==NULL)  for($i=0;$i<sizeof($comments); $i++)
      			 : ?>
      			 <div id="<?=$comments[$i]['comment_id']?>">
      			<img src="<?=$comments[$i]['comment_image']?>">
      			<?=$comments[$i]['comment_name']?>
      			<?=$comments[$i]['comment_text']?>
			</div>
			<?php endfor} ?>

	</div>
	<form id="write_comment">
		<img src="$image">
		<?php echo '$name';?>";
		<textarea id="<?php echo($com_id);?>" class="comment_field"></textarea>
		<input type="submit" name="send" id="<?php echo($com_id);?>" value="send" class="send">
	</form>

</body>
</html>
	