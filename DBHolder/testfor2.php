
<?php
	
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	require_once 'ClientManager.php';
	
	session_start();
	if(isset($_SESSION['email']))
	{
		
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
		
		
	
	}else{
		echo 'you dont have permission to login this page';
		echo '<a href="login.php">LOGIN </a>';
			
	}

		$proFlag = 'false';
		$clientFlag = 'false';
		$client = new ClientManager();
		$clientINFO = $client->selectQuery("SELECT * FROM client WHERE email='$email'");
		$clientPro = $client->getAllProductsBelongToClient($email, $password);

		if($clientINFO!==NULL)
			$clientFlag = 'true';
		
		if($clientPro!==NULL)
			$proFlag = 'true';

		
		
		
		
?>

<!DOCTYPE html>

<html>
	<head>
		<title>
			home
		</title>
		<link href="style.css" rel="stylesheet">   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script src="jquery.js">
		
		</script>
		
		<script>
				let clientINFO;
				let clientPro;
				let finalResult1;
				let finalResult2;

			$(document).ready(function(){
				//repair null values
				let clientState = '<?php echo($clientFlag);?>';
				if(clientState==='true'){
					
					 clientINFO = ('<?php echo json_encode($clientINFO);?>');
					finalResult1 = JSON.parse(clientINFO);
					showClientInfo(finalResult1);

				}
				let proState = '<?php echo($proFlag);?>';
				if(proState==='true'){
					 clientPro = ('<?php echo json_encode($clientPro);?>');
					finalResult2 =JSON.parse(clientPro);
					
					showAllProducts(finalResult2);
					
				}

				$('.anotherLink').click(function(event){
					event.preventDefault();
					d = $(this).attr("id");    //
					pro_id = finalResult2[d].pro_id;
					
					$.ajax({
						type:'post',
						url:'deleteClientPro.php', 
						data:{pro_id:pro_id}, 
						success:function(result){
							$('#'+d).remove();
						}
					});


				});

				$('#Upload').click(function(){
					event.preventDefault();
					var fd = new FormData();
					var files = $('#uploadImage')[0].files;
					console.log(files[0].name);
					if(files.length>0){
						fd.append('uploadImage', files[0]);
						$.ajax({
							url:'addClientImg.php', 
							type:'post', 
							data:fd,
							contentType:false, 
							processData:false, 
							success:function(response){
								if(response!==0){
									alert('done');
									console.log(response+'^');
									$('#img').attr("src", response);
									$('.des-Img').show();
								}else{
									alert(response);
								}
							} 
						});
					}else{
						alert('please select an image');
					}
				});

				
			});

			
				
				
		</script>
	</head>
	
	<body>
		<a href="addClientPro.php">Add new product</a>
		<div id="demo">
		
		</div>
		
		
		
		<script>
			function showAllProducts(myObj){
				//generationg new div and its edit and delete link
				
				let returnedString = '';
				
				for(let i = 0; i <myObj.length; ++i){
				var obj = myObj[i];
				let divElement = document.createElement('div');
				var obj = myObj[i];
				/*returnedString='Name:'+obj.pro_name+"\namount: "+obj.amount+"\ncost: "+obj.cost+"\nproduction_date: "+obj.production_date+"\ndiscount_percent: "+obj.discount_percent+"\ndate of modify: "+obj.date_of_modify+'\nDate of expose: '+obj.date_of_expose+'\nnumber of sells: '+obj.num_sell+'\nnumber of likes: '+obj.num_likes+'\nRate: '+obj.rate+'\nimage url:'+decodeURIComponent(obj.image);
				
				let elemText = document.createTextNode(returnedString);
				divElement.appendChild(elemText);*/
				divElement.setAttribute('id', i);
				divElement.setAttribute('class', 'col-lg-2 col-md-4 col-sm-12');
				let cardDiv = document.createElement('div');
				cardDiv.setAttribute('class', 'card');
				document.body.appendChild(cardDiv);
				let imgPro = document.createElement('img');
				imgPro.setAttribute('class', 'card-img-top');
				imgPro.setAttribute('src', obj.image);
				document.body.appendChild(imgPro);
				cardDiv.appendChild(imgPro);
				divElement.appendChild(cardDiv); 
				let cardBody = document.createElement('div');
				cardBody.setAttribute('class', 'card-body');
				cardDiv.appendChild(cardBody);

				let H5 = document.createElement('h5');
				H5.setAttribute('class', 'card-title');
				let pro_name = document.createTextNode(obj.pro_name);
				H5.appendChild(pro_name);
				document.body.appendChild(H5);
				cardBody.appendChild(H5);
				document.body.appendChild(divElement);

				let H1 = document.createElement('h1');
				H5.setAttribute('class', 'card-title pricing-card-title');
				let obj = document.createTextNode(obj.price);
				H5.appendChild(pro_name);
				document.body.appendChild(H1);
				cardBody.appendChild(H1);
				document.body.appendChild(divElement);

				let cardText = document.createElement('p');
				cardText.setAttribute('class', 'card-text pricing-card-title');
				let details = 'some details:';
				cardText.createTextNode(details);
				cardText.appendChild(details);
				document.body.appendChild(cardText);
				cardBody.appendChild(cardtext);
				
				//edit link
				
				/*var myLink = document.createElement('a');
				myLink.setAttribute('href', "editClientPro.php?pro_id="+obj.pro_id+"&pro_name="+obj.pro_name+"&amount="+obj.amount+"&cost="+obj.cost+"&production_date="+obj.production_date+"&discount_percent="+obj.discount_percent+"&rate="+obj.rate+"&aboutproduct="+obj.description+"&selectedImgURL="+obj.image);
				myLink.classList.add('edit');
				myLink.setAttribute('id', i);
				myLink.setAttribute('class', 'myLinks');
				myLink.innerText = 'edit';
				document.body.appendChild(myLink);
				
				myLink.value='edit';
				divElement.appendChild(myLink);
				
				//delete link
				
				let anotherLink = document.createElement('a');
				let linkedString = "deleteClientPro.php";
				anotherLink.setAttribute('href', linkedString);
				anotherLink.innerText = 'delete';
				anotherLink.setAttribute('id', i);
				anotherLink.setAttribute('class', 'anotherLink');
				anotherLink.classList.add('delete');
				document.body.appendChild(anotherLink);
				
				anotherLink.value='delete';
				divElement.appendChild(anotherLink);
				divElement.classList.add('divEement');
				
			
			//setAttirubutes
			let tg = document.createElement('br');
			document.body.appendChild(tg);
			
				
				divElement.setAttribute('style', 'color:black;background-color:rgb(150, 220, 204);white-space:pre;');*/
				
			}
			
		}

		function showClientInfo(myObj){
			let divElement = document.createElement('div');
			let returnedString = '';

			for(i=0;i<myObj.length;++i){
				var obj = myObj[i];
				returnedString="client name: "+obj.username+"\nemail: "+obj.email+'\n';
			   about_you =  obj.about_you;
			   returnedString+='about you: '+decodeURI(about_you);
				let elemText = document.createTextNode(returnedString);
				divElement.appendChild(elemText);
				document.body.appendChild(divElement);
				divElement.setAttribute('style', 'color:white;background-color:rgb(205, 150, 153);white-space:pre;');
					$('#img').attr("src", obj.image);
					$('.des-Img').show();
			}
		}

		function eidtProfile(){
			
			window.location.href="editClientProfile.php?username="+finalResult1[0].username+"&email="+finalResult1[0].email+"&about_you="+finalResult1[0].about_you+"&password="+finalResult1[0].password;
		}
		
		
		</script>

		<form id="com_image" enctype = "multipart/form-data" method="POST" action="">
			<img src="" id="img" width="100" height="100" class="des-Img">

			<input type="file" name="uploadImage" id="uploadImage" >
			<input type="button" name="Upload" id="Upload" value="add logo">
		</form>

		<input type="submit" name="edit-profile" id="edit-profile" onclick="eidtProfile()" value="edit profile"> 

		<div id="success">
		</div>

		<div id="error">
		</div>
	</body>
</html>