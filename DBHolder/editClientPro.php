<?php
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	
	session_start();
	if(isset($_SESSION['email']))
	{	
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
		

	}
	else{
		echo 'you dont have permission to add product <br> you dont have account';
		//redireting to HOME
	}

	$pro_id = '';
	$pro_name = '';
	$amount = '';
	$cost = '';
	$production_date = '';
	$discount_percent = '';
	$rate = '';
	$aboutproduct = '';
	$selectedImgURL = '';
		if(isset($_GET['pro_id']))
		{
			$pro_id = htmlspecialchars($_GET['pro_id']);
			$pro_name = htmlspecialchars($_GET['pro_name']);
			$amount = htmlspecialchars($_GET['amount']);
			$cost = htmlspecialchars($_GET['cost']);
			$production_date = htmlspecialchars($_GET['production_date']);
			$discount_percent = htmlspecialchars($_GET['discount_percent']);
			$rate = htmlspecialchars($_GET['rate']);
			$aboutproduct = htmlspecialchars($_GET['aboutproduct']);
			$selectedImgURL = htmlspecialchars($_GET['selectedImgURL']);
			
		
		}
//////////////////////////////////////////////////////////////////////////////////////////////////


?>

<!DOCTYPE html>

<html>
	<head>
		<title>
			edit a product
		</title>
		<script src="jquery.js">
		
		</script>


		<script>
			
	$(document).ready(function(){
		selectedImageURL = '<?php echo($selectedImgURL);?>';
		$('#img').attr("src", '<?php echo($selectedImgURL);?>');
		$('.des-Img').show();

		$('#Upload').click(function(){
					event.preventDefault();
					var fd = new FormData();
					var files = $('#uploadImage')[0].files;
					console.log(files[0].name);
					if(files.length>0){
						fd.append('uploadImage', files[0]);
						$.ajax({
							url:'addClientProImg.php', 
							type:'post', 
							data:fd,
							contentType:false, 
							processData:false, 
							success:function(response){
								if(response!==0){
									alert('done');
									$('#img').attr("src", response);
									selectedImageURL = response;
									$('.des-Img').show();
									selectedImageURL = selectedImageURL.replace(/(?:\\[rn]|[\r\n]+)+/g, "");
									selectedImageURL = encodeURIComponent(selectedImageURL);
									console.log(selectedImageURL+'       after');

								}else{
									alert(response);
								}
							} 
						});
					}else{
						alert('please select an image');
					}
				});

		$("#addName").click(function(event){
				
				event.preventDefault();
				
					name = $("#name").val();
					amount = $("#amount").val();
					cost = $("#cost").val();
					production_date = $("#production_date").val();
					pro_id = '<?php echo($pro_id);?>';
					discount_percent = $("#discount_percent").val();
					rate = $("#rate").val();
					d = $("#aboutproduct").val();
					aboutproduct =d.replace(/\"/g, "").replace(/\'/g, "");
					aboutproduct = encodeURI(aboutproduct); 
					
					$.post("processClientPro.php", {
						name:name,
						amount:amount,
						cost:cost, 
						production_date:production_date, 
						discount_percent:discount_percent,
						rate:rate,
						pro_id:pro_id, 
						aboutproduct:aboutproduct, 
						selectedImageURL:selectedImageURL
						
						
					}, function(flag){
						if(flag ==''){
							document.getElementById("submittedFlag").innerHTML = 'product edited<br>';
							window.setTimeout(function(){window.location.href="ajaxtest2.php";}, 2000);
						}else{
							document.getElementById("submittedFlag").innerHTML =flag;
						}
					
					/*else{
						document.getElementById("submittedFlag").innerHTML = '';
						$("#confirm").show();
						document.getElementById("message").innerHTML = 'there is alredy product in this nameanDo you want to replaceit or edit it';
						$("#replace").click(function(event){
							event.preventDefault();
							$.post("replaceProduct.php", {
								name:name,
								amount:amount,
								cost:cost, 
								production_date:production_date, 
								discount_percent:discount_percent,
								
								
							}, function(data){
								document.getElementById("submittedFlag").innerHTML = '<p style="color:green;">'+data+'</p>';
								/*window.setTimeout(function(){window.location.href="ajaxtest1.php";}, 1000);*/
								
							/*}); 
							
						});
						
						$("#add-the-amount").click(function(event){
							event.preventDefault();
							myObj = JSON.parse(flag);
							$.post("addAmount.php", {
								name:name, 
								amount:amount,
								pro_id:myObj[0]['pro_id'],
								com_id:myObj[0]['comp_id']
							}, 
							function(data){
								document.getElementById("submittedFlag").innerHTML = data;
								window.setTimeout(function(){window.location.href="ajaxtest1.php?";}, 1000);
							}
							);
							
						});
					
					}*/
					}
					);
			
			});

		
				

		});
			
		
		</script>

		
		
	</head>
	
	<body>
		<form id="addPro">
			<label for="name">
				product name:
			</label>
			<input type="text" name="name" id="name" value="<?php echo($pro_name);?>">

			<label for="production_date">
				date of production
			</label>
			<input type="date" name="production_date" id="production_date" value="<?php echo($production_date);?>">
			
			<label for="discount_percent"> discount percent</label>
			<input type="number" name="discount_percent" id="discount_percent" value="<?php echo($discount_percent);?>">

			<label for="rate">
				rate
			</label>
			<input type="number" name="rate" id="rate" value="<?php echo($rate);?>">
			<label for="amount">amount</label>
			<input type="number" name="amount" id="amount" value="<?php echo($amount);?>">

			<label for="cost">cost</label>
			<input type="number" name="cost" id="cost" value="<?php echo($cost);?>">
			<textarea id="aboutproduct" name="aboutproduct"><?php echo $aboutproduct;?></textarea>
			
			<input type="submit" name="addName" id="addName" value="edit" >
			
		</form>

		<form id="com_image" enctype = "multipart/form-data" method="POST" action="">
			<img src="" id="img" width="100" height="100" class="des-Img">

			<input type="file" name="uploadImage" id="uploadImage" >
			<input type="button" name="Upload" id="Upload" value="add logo">
		</form>
		
		<p id = "form-state">
		
		</p>

		<p id="submittedFlag">
		
		</p>
		
		
		
	</body>
</html>