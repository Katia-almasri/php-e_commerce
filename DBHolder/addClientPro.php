<?php
	require_once 'DBManager.php';
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
	
	
	
	$manager = new ProductManager();
	$category = $manager->selectQuery("SELECT * FROM category");
	//$finalRes = json_encode($result);
	$item = $manager->selectQuery("SELECT * FROM item_cat");
	$final_result_item = json_encode($item);
	
		
?>


<!DOCTYPE html>

<html>
	<head>
		<title>
			add new product
		</title>
		<script src="jquery.js">
		
		</script>
		
		<style type="text/css">
			.des-Img{
				display: none;
			}
		</style>
		
	</head>
	
	<body>
		<form id="confirm" style="display:none;">
			<p id="message">
			
			</p>
			<button class="replace" id="">
				replace
			</button>
			
			<button id="add-the-amount">
				add the amount
			</button>
		 
		</form>
		
		<!--main form--->
		
		<form id="addPro">
			<label for="name">
				product name:
			</label>
			<input type="text" name="name" id="name">

			<label for="production_date">
				date of production
			</label>
			<input type="date" name="production_date" id="production_date">
			
			<label for="rate">
				rate
			</label>
			<input type="number" name="rate" id="rate">
			<label for="amount">amount</label>
			<input type="number" name="amount" id="amount">

			<label for="cost">cost</label>
			<input type="number" name="cost" id="cost">
			<label for="category">
				category
			</label>   
			<!--new options----------->
			<select id="category" name="category">
				<?php
	 				if($category!==NULL)  for($i=0;$i<sizeof($category); $i++)
      			 : ?>
      			 <option id="<?=$category[$i]['cat_id']?>" value="<?=$category[$i]['name']?>"><?=$category[$i]['name']?></option>
      			 <?php endfor ?>
			</select>
			<label for="item">
				item
			</label>
			<select id="item" name="item">
				<?php
	 				if($item!==NULL)  
	 					for($i=0;$i<sizeof($item); $i++)
	 						if($category[0]['cat_id'] === $item[$i]['cat_id']){
	 			?>

      			 <option id="<?=$item[$i]['item_id']?>" value="<?=$item[$i]['item_name']?>"><?=$item[$i]['item_name']?></option>

      			
      			 <?php } ?>
      			
			</select>
			<!--new for weight of product in kg----->
			<label for="weight">weight</label>
			<input type="number" name="weight" step= 0.01 id="weight" class="weight">
			<!------------------------------------------------------------------------->
			<textarea id="aboutproduct" name="aboutproduct"></textarea>
			
			<input type="submit" name="addName" id="addName" value="add product">
			
		</form>

		<form id="client_image" enctype = "multipart/form-data" method="POST" action="">
			<img src="" id="img" width="100" height="100" class="des-Img">

			<input type="file" name="uploadImage_pro" id="uploadImage_pro" >
			<input type="button" name="Upload" id="Upload" value="add logo">
		</form>
		
		<p id="submittedFlag">
		
		</p>
		
	<script>
			
					/*	let result_cat = JSON.parse('<?php //echo $finalRes;?>');
						let result_item = JSON.parse('<?php //echo $final_result_item;?>');
						
						//creatig dynamic options
						for(let i =0; i<result_cat.length;++i){
							
						let cat_option = document.createElement("option");
							cat_option.value = result_cat[i].name;
							cat_option.text=result_cat[i].name;
							cat_option.id = result_cat[i].cat_id;
							document.getElementById("category").appendChild(cat_option);
						}
						
						
		//selecting special item for each category
						let selected_cat = document.getElementById("category");
						
						for(i = 0; i < result_item.length; ++i){
							
							if(result_item[i].cat_id==selected_cat.options[selected_cat.selectedIndex].id){
							let newOption = document.createElement("option");
							newOption.value = result_item[i].item_name;
							
							newOption.text = result_item[i].item_name;
							newOption.id = result_item[i].item_id;
							
							document.getElementById("item").appendChild(newOption);
							}
						
						}*/
					
		$(document).ready(function(){
			selectedImageURL = 'proclient/defaultProduct.png';
			$('#img').attr("src", selectedImageURL);
			$('.des-Img').show();
			$("#category").change(function(event){
				event.preventDefault();
				var el = $("#category").children(':selected').attr('id');
				el = parseInt(el, 10);
				console.log(typeof el);
				let result_item = JSON.parse('<?php echo $final_result_item;?>');
					$("#item").empty();
						for(i = 0;i <result_item.length; ++i){
							
							if(result_item[i].cat_id==parseInt(el, 10)){
							 
							let newOption = document.createElement("option");
							newOption.value = result_item[i].item_name;
							
							newOption.text = result_item[i].item_name;
							newOption.id = result_item[i].item_id;
							
							document.getElementById("item").appendChild(newOption);
						
							}
						
						}
	
			});

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
									alert('done');
									$('#img').attr("src", response);
									$('.des-Img').show();
									selectedImageURL = response.replace(/(?:\\[rn]|[\r\n]+)+/g, "");
									console.log(selectedImageURL);
	
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
					/*generating item accor
					ding to category*/
					rate = $("#rate").val();
					category = $("#category").val();
					item = $("#item").find('option:selected').attr('id');
					console.log(item+'  ^');
					   /////////
					d = $("#aboutproduct").val();
					aboutproduct =d.replace(/\"/g, "").replace(/\'/g, "");
					weight = $("#weight").val();
					
					 //new 
					$.post("validateClientAddition.php", {
						name:name,
						amount:amount,
						cost:cost, 
						production_date:production_date, 
						rate:rate,
						item:item,
						selectedImageURL:selectedImageURL, 
						aboutproduct:aboutproduct,
						weight:weight
						
						
					}, function(flag){
						
					if(flag === 'true'){
						document.getElementById("submittedFlag").innerHTML = '<p style="color:red;">invalid inputs!<br></p>';
						
					}else if(flag.search("false")!=-1){
						document.getElementById("submittedFlag").innerHTML = '<p style="color:green;">new product just added..!<br></p>'+flag;
						window.setTimeout(function(){window.location.href="ajaxtest2.php";}, 1000);
					}
					
					else{
						document.getElementById("submittedFlag").innerHTML = flag;
						
						}
							
					
			
			});
				});

			$("#submittedFlag").mouseover(function(){
				$(".replace").unbind("click");			
				$(".replace").click(function(event){
					event.preventDefault();
					proclient_id = $(this).attr('id');
					alert(proclient_id);
					$.ajax({
						type:'post',
						url:'replaceClientPro.php', 
						data:{proclient_id:proclient_id,
							name:name,
							amount:amount,
							cost:cost,
							production_date:production_date,
							rate:rate,
							selectedImageURL:selectedImageURL,
							aboutproduct:aboutproduct

						},
						success:function(result){
							alert(result);
							$("#msg").css('display', 'none');
							window.setTimeout(function(){window.location.href="ajaxtest2.php";}, 1000);

						}
					});
				
				});

		});

			$("#submittedFlag").mouseover(function(){
				$(".cancel").unbind("click");
				$(".cancel").click(function(event){
					event.preventDefault();
					$("#msg").css('display', 'none');
					window.setTimeout(function(){window.location.href="ajaxtest2.php";}, 1000);
				});

		});
					


		});	

		
	</script>
	
	</body>

</html>