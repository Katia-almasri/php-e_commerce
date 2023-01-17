<?php
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	
	session_start();
	if(isset($_SESSION['email']))
	{	
		$email = $_SESSION['email'];
		$psd = $_SESSION['psd'];

	}
	else{
		echo 'you dont have permission to add product <br> you dont have account';
		exit();
	}


	$procomp_id = '';
	$cost = 0;
	$amount = 0;
	$production_date = '';
	$rate = 0;
	$image = '';
	if(isset($_GET['procomp_id'])){
		$procomp_id = htmlspecialchars($_GET['procomp_id']);
		$product = new ProductManager();
		$procomp = $product->selectQuery("SELECT * FROM procomp WHERE procomp_id = '$procomp_id'");
		if($procomp!==NULL){

			$cost = $procomp[0]['cost'];
			$amount = $procomp[0]['amount'];
			$production_date = $procomp[0]['production_date'];
			$rate = $procomp[0]['rate'];
			$image = $procomp[0]['image'];
		}
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>edit</title>
	<script src="jquery.js">
	</script>

</head>
<body>

	<script type="text/javascript">
		
		$(document).ready(function(){

			editedImage = 'procomp/defaultman.png';

			$('#Upload').click(function(){
					event.preventDefault();
					var fd = new FormData();
					var files = $('#uploadImage_pro')[0].files;
					console.log(files[0].name);	
					if(files.length>0){
						fd.append('uploadImage_pro', files[0]);
						$.ajax({
							url:'addProductImage.php', 
							type:'post', 
							data:fd,
							contentType:false, 
							processData:false, 
							success:function(response){
								if(response!==0){
									response = response.replace(/(\r\n|\n|\r)/gm, "");
									editedImage = response;
									console.log(response+'^');
									$('#img').attr("src", response);
									$('#img').show();
								}else{
									alert(response);
								}
							} 
						});
					}else{
						alert('please select an image');
					}
				});

			$("#edit").click(function(event){
				event.preventDefault();

				amount = $("#amount").val();
				production_date = $("#production_date").val();
				cost = $("#cost").val();
				aboutProduct = $("#about_product").val();
				rate = $("#rate").val();
				procomp_id = "<?php echo($procomp_id);?>";
				alert(procomp_id);

				$.ajax({
					type: "POST",
					url: "processProduct.php",
					data:{
						amount:amount, 
						procomp_id:procomp_id,
						production_date:production_date, 
						cost:cost, 
						rate:rate,
						image:editedImage
						
					},
					success: function(result){
					alert(result);
					window.setTimeout(function(){window.location.href="ajaxtest1.php";}, 3000);
					
					}
					});
			});
		});
	</script>

	<form id="com_image" enctype = "multipart/form-data" method="POST" action="">
			<img src="<?php echo($image);?>" id="img" width="100" height="100" class="des-Img">

			<input type="file" name="uploadImage_pro" id="uploadImage_pro" >
			<input type="button" name="Upload" id="Upload" value="add logo">
	</form>

	<form id="addPro">

			<label for="production_date">
				date of production
			</label>
			<input type="date" name="production_date" id="production_date" value="<?php echo($production_date);?>">
			
			<label for="rate">
				rate
			</label>
			<input type="number" name="rate" id="rate" value="<?php echo($rate);?>">

			<label for="amount">amount</label>
			<input type="number" name="amount" id="amount" value="<?php echo($amount);?>">

			<label for="cost">cost</label>
			<input type="number" name="cost" id="cost" value="<?php echo($cost);?>">

			<label for="about_product">description</label>
						
			<input type="submit" name="edit" id="edit" value="edit">
			
		</form>
		
		<p id = "form-state">
		
		</p>

		<p id="submittedFlag">
		
		</p>


</body>
</html>
