
<?php
	
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	require_once 'ClientManager.php';
	require_once 'clientstatistics.php';
	

	$email = '';
	$password = '';
	$client_id = 0;
	session_start();
	if(isset($_SESSION['password']))
	{
		
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
		

	}else{
		echo 'you dont have permission to login this page';
		echo '<a href="login.php">LOGIN </a>';
		exit();
			
	}
	
	$client = new ClientManager();	
	$clientINFO = $client->selectQuery("SELECT * FROM client WHERE email= '$email'");
	$GLOBALS['client_info'] = $clientINFO;
	$GLOBALS['client_pro'] = '';
	$_SESSION['client_id'] = $clientINFO[0]['client_id'];
	$client_id = $_SESSION['client_id'];
	 

	 function showAllProducts($email, $password){
	 	$client = new ClientManager();
	 	$products = $client->getAllProductsBelongToClient($email, $password);
	 	$output = '';
	 	if($products!==NULL)
	 		{
	 			$GLOBALS['client_pro'] = $products;
	 			for($i=0;$i<sizeof($products);$i++){
	 				$proclient_id = $products[$i]['proclient_id'];
		 				$img = $products[$i]['image'];
	 				preg_replace( "/\r|\n/", "", $img);
	 				$output.="<div id='$proclient_id'>";
	 				$output.="<img src='$img' id='img_pro' width='100' height='100' class='des-Img'>";
	 				$description = preg_replace( "/\r|\n/", "<br>", $products[0]['description']);
	 				$output.='about product: '.$description.'<br>';
	 				$output.='product name: '.$products[$i]['pro_name'].'<br>amount: '.$products[$i]['amount'].'<br>cost: '.$products[$i]['cost'].'<br>production date: '.$products[$i]['production_date'].'<br>';
	 				$output.="<input type='button' id='$proclient_id' class='edit_pro' value='edit'>";
	 				$output.="<input type='button' id='$proclient_id' class='remove_pro' value='remove'></div>";
	 			}
	 			
	 			
	 		}else
	 			$output='no product!!<br>';
	 		return $output;
	 }

	
		
?>

<!DOCTYPE html>

<html>
	<head>
		<title>
			home
		</title>
		<script src="jquery.js">
		
		</script>
		<style type="text/css">

		#notification_count
		{
			padding: 0px 3px 3px 7px;
			background: #cc0000;
			color: #ffffff;
			font-weight: bold;
			margin-left: 77px;
			border-radius: 9px;
			-moz-border-radius: 9px;
			-webkit-border-radius: 9px;
			position: absolute;
			font-size: 15px;
			z-index: 1;
		}
		</style>
		
		 <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>profile with data and skills - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href= "..//webfonts/css/style.css" rel="stylesheet" > 
	      <link href="..//webfonts/css/all.css" rel="stylesheet">
	      <link href="..//webfonts/css/all.min.css" rel="stylesheet">
	       <link href="..//webfonts/css/product.css" rel="stylesheet">
	      <link href="..//webfonts/css/brands.css" rel="stylesheet">
	      <link href="..//webfonts/css/fontawesome.min.css" rel="stylesheet">
	      <link href="..//webfonts/css/profile_with_data.css" rel="stylesheet">

		<script>
				

		function cutpro(type, pro){
		console.log(pro);
		var products = pro.products;

		$("#pro_char").empty();
		$("#pro_char").html(products);
			

	}

	 function addmsg(type, msg){
	 console.log(msg.unseen_notification);
 	 document.getElementById('notification_count').innerHTML=msg.unseen_notification;
	}

	function cutmsg(type, msg1){
	 var bell = msg1.bell;
	// document.getElementById('notification_count').innerHTML=msg1.unseen_notification;
	len = $('.dropdown-menue li').length;
	if(len==0){
		$('.dropdown-menue').empty();
	    $('.dropdown-menue').append(bell);
	    
	}else{
		if(event!=='<li>no new notification</li>')
			{
				$('.dropdown-menue').empty();
				$('.dropdown-menue').append(bell);
			}

	}

 	document.getElementById('notification_count').innerHTML=msg1.unseen_notification;
 
	}

	 function removeNotification(){
	 	client_id = "<?php echo($client_id);?>";
		$.ajax({
		type: "POST",
		url: "removeClientBell.php",
		async: true,
		cache: false,
		timeout:50000,
		dataType:"json",
		data:{client_id:client_id},
		success: function(data){
		console.log(data);
		cutmsg("new", data);
		setTimeout(
		waitForMsg,
		1000
		);

		}
		});
	}

	function waitForMsg(){
		client_id =  "<?php echo($client_id);?>";
		$.ajax({
		method: "GET",
		url: "selectClientBell.php",
		async: true,
		cache: false,
		timeout:50000,
		dataType:"json",
		data:{client_id:client_id}, 
		success: function(data){
		addmsg("new", data);
		setTimeout(
		waitForMsg,
		1000
		);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown){
		addmsg("error", textStatus + " (" + errorThrown + ")");
		setTimeout(
		waitForMsg,
		15000);
		}

		});
		}


	function waitForNewProducts(client_id){
		$.ajax({
		method: "POST",
		url: "loadClientPro.php",

		async: true,
		cache: false,
		timeout:50000,
		dataType:"json", 
		data:{client_id:client_id},
		success: function(data){

		
		setTimeout(
		waitForNewProducts,
		1000
		);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown){
		
		setTimeout(
		waitForNewProducts,
		15000);
		}

	});

	}

	function removeProducts(client_id){
		$.ajax({
			type: "GET",
			url: "removeClientPro.php",
			 
			async: true,
			cache: false,
			timeout:50000,
			dataType:"json",
			date:{client_id:client_id},
			success: function(data){
			console.log(data);
			cutpro("new", data);
			setTimeout(
			waitForNewProducts,
			1000
			);

			}
			});
	}

		</script>
		<script>
				$(document).ready(function(){

				waitForMsg();
				//variables to edit 
				var rate = 0.00;
				var production_date = '';
				var amount = 0;
				var cost = 0;
				var image = '';
				var proclient_id = 0;
				//to get the last order
				var cnt_order = 1;

				waitForNewProducts("<?php echo($clientINFO[0]['client_id']);?>");
				image_pro = 'proclient/defaultProduct.png';
				$("#img").attr("src", "<?php echo($clientINFO[0]['image']);?>");
				$("#username").html("<?php echo($clientINFO[0]['username']);?>");

		$("#edit_my_info").click(function(){
			$("#edit_client_info").show();
		});

		$("#edit").click(function(event){
			event.preventDefault();
			username =  $("#edit_username").val();
			nu =  $("#edit_nu").val();
			work = $("#edit_work").val();
			email =  $("#edit_email").val();
			password =  $("#edit_password").val();
			client_location =  $("#edit_client_location").val();
			about_you =  $("#edit_about_you").val();
			about_you = about_you;
			

			 	$.ajax({
					type: "POST",
					url: "editClientProfile.php",
					data:{
						username:username, 
						email:email,
						password:password,
						client_location:client_location, 
						about_you:about_you,
						nu:nu,
						work:work,
						about_you:about_you
						
					},
					success: function(data){
					alert(data);
					$("#edit_client_info").css('display', 'none');
					
					}
					});


		});

		$("#add_product").click(function(event){
			event.preventDefault();
			window.location.href="addClientPro.php";
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
									$('#img').show();
								}else
									alert(response);
								
							} 
						});
					}else
						alert('please select an image');
					
				});

		$('#Upload_pro').click(function(){
					event.preventDefault();
					var fd = new FormData();
					des_img = $(".des-Img-pro").attr('id');
					console.log(des_img);
					var files = $('#uploadImage_pro')[0].files;
					console.log(files[0].name);	
					if(files.length>0){
						fd.append('uploadImage_pro', files[0]);
						$.ajax({
							url:'addClientProtImg.php', 
							type:'post', 
							data:fd,
							contentType:false, 
							processData:false, 
							success:function(response){
								if(response!==0){
									alert('done');
									response = response.replace(/(\r\n|\n|\r)/gm, "");
									console.log(response+'^');
									$('.des-Img-pro').attr("src", response);
									$('.des-Img-pro').show();

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
			production_date = $("#production_date").val();
			rate = $("#production_date").val();
		});

		

		$(".edit_pro").click(function(event){
			event.preventDefault();
			 proclient_id = $(this).attr('id');
			console.log(proclient_id);
			$("#editedPro").show();
			$("#image_pro").show();
			 rate_old = $('#'+proclient_id+' #rate').html();
			 production_date_old = $('#'+proclient_id+' #production_date').html();
			 amount_old = $('#'+proclient_id+' #amount').html();
			 cost_old = $('#'+proclient_id+' #cost').html();
			 image_old = $('#'+proclient_id+' .image').attr('src');
			 production_date_old  = production_date_old.replace(/\s/g, '');

		    console.log(production_date_old);
		    console.log(typeof production_date);
			$("#editedPro .production_date").attr('id', production_date_old);
			$("#editedPro .production_date").val(production_date_old);
			$("#editedPro .rate").val(rate_old);
			$("#editedPro .amount").val(amount_old);
			$("#editedPro .cost").val(cost_old);
			$(".des-Img-pro").attr('src', image_old);
			
		});

		$("#edit_product").click(function(event){
			event.preventDefault();
			rate = $("#editedPro .rate").val();
			production_date = $("#editedPro .production_date").val();
			amount = $("#editedPro .amount").val();
			cost = $("#editedPro .cost").val();
			image =  $(".des-Img-pro").attr('src');
			alert(image);
			$.ajax({
					type: "POST",
					url: "processClientPro.php",
					dataType:'json',
					data:{
						rate:rate, 
						production_date:production_date,
						amount:amount,
						cost:cost, 
						image:image, 
						proclient_id:proclient_id
						
					},
					success: function(data){
					if(data!==true){
						$("#editedPro").css('display', 'none');
						$("#image_pro").css('display', 'none');
						
						$('#'+proclient_id+' #production_date').html(data.production_date);
						$('#'+proclient_id+' #rate').html(data.rate);
						$('#'+proclient_id+' #cost').html(data.cost);
						$('#'+proclient_id+' #amount').html(data.amount);
						$('#'+proclient_id+' .image').attr('src', data.image);
					}else{
						alert('wrong input!!');
					}
				}
					});
		});

		$(".delete_pro").click(function(event){
			event.preventDefault();
			proclient_id = $(this).attr('id');
			console.log(proclient_id);
			$.ajax({
						type:'POST',
						url:'deleteClientPro.php', 
						data:{proclient_id:proclient_id},
						success:function(result){
							alert(result);
							$('#'+proclient_id).remove();
							removeProducts(proclient_id);
							//document.getElementById("admin_action").innerHTML = result;
						}
					});

		});

		
		$("#more").click(function(event){
			event.preventDefault();
			cnt_order = cnt_order+1;
			$("#con").load("load_last_order.php", {
			cnt_order:cnt_order,
			client_id:"<?php echo($client_id);?>"
			},
			function(result){
				console.log(result);
				$('#con').empty();
   				$('#con').append(result);

   				 
			}
			);
			});	

		$("#bell").click(function(event){
			event.preventDefault();
			
			removeNotification();
			
			});

		
	});


</script>
		
	</head>
	
	<body>
				
			  <nav class="navbar navbar-expand-xl navbar-light bg-white  border-bottom shadow-lg">
  <a class="brand" href="product.htm#" ><i class="fas fa-dumpster-fire" style="font-size: 40px;"></i> </a> 
        <a class="flag navbar-brand font-weight-normal" href="product.htm" style="color: dodgerblue ; font-size: 30px"  >MarkTech </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarCollapse">
       
     <input class="form-control input-lg" type="text" placeholder="Search " aria-label="Search">  
      <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
    <ul class="navbar-nav mr-auto">
         <li class="nav-item icon">
         	<span id="notification_count" class="noti"></span>
        <a class="btn btn-sm " id="bell"><i class="far fa-bell"></i>Notifications</a>
      </li> 
      <li class="nav-item active icon">
        <a class="btn btn-sm " href="product.htm" ><i class="far fa-user-circle"></i>Account <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item icon" >
        <a class="btn btn-sm" href="form2.html" style="margin-right: 2rem"><i class="fab fa-salesforce"></i>Sale</a>
      </li>
    </ul>
     <a href="checkout.htm" style="padding-left: 1%; font-size: 2rem"><i class="fas fa-shopping-cart" ></i>  </a>
  </div>
</nav>
<div class="container">
    <div class="main-body">
          <!-- /Breadcrumb -->
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                  	<form id="client_image" enctype = "multipart/form-data" method="POST" action="">
			<img src="" id="img" height="100" alt="Client" class="rounded-circle des-Img" width="150">

			
		</form>
                    <div class="mt-3">
                      <h4 name="username" id="username"> <?php echo($GLOBALS['client_info'][0]['username']);?></h4>
                      <p name="birthdate" id="birthdate" class="text-secondary mb-1"> <?php echo($GLOBALS['client_info'][0]['birthdate']);?></p>
                      <p name="client_location" id="client_location"  class="text-muted font-size-sm"><?php echo($GLOBALS['client_info'][0]['location']);?> </p>
                      <p name="level" id="level" class="text-muted font-size-sm"> <?php if($GLOBALS['client_info'][0]['level']==0)echo "normal"; else echo "vip";?></p>
                      
                      <button class="btn btn-outline-primary"><a href="addClientPro.php"> Add Product</a></button>
                     <input type="file" name="uploadImage" id="uploadImage" class="btn btn-outline-primary"  >
					<input type="button" name="Upload" id="Upload" value="add your photo" class="btn btn-outline-primary">
                    </div>
                  </div>
                </div>
              </div>
             <div class="card mt-3">
        <h3 class="text-center">
        <span class="text-muted ">The value of the last bill</span>
         </h3>
      <ul class="list-group mb-3">
      	<div id="con">
      	<?php 

      		$client = new ClientManager();
      		$lastOrder = $client->selectQuery("SELECT * FROM order_client WHERE client_id = '$client_id' ORDER BY date_order DESC LIMIT 1");
      		if($lastOrder!==NULL){
      			for($j=0; $j<sizeof($lastOrder); $j++){
      			$items = getItems($lastOrder[0]['order_id'], 'client');
          			for($i = 0; $i<sizeof($items); $i++){
      	?>
      	 <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"><?php echo $items[$i]['product_name'];?></h6>
            <small class="text-muted">amount: <?php echo $items[$i]['amount'];?></small>
          </div>
          <span class="text-muted"><?php echo $items[$i]['tot_cost'].'$';?></span>
        </li>
    <?php }?>
    		<li class="list-group-item d-flex justify-content-between bg-light">
          <div class="text-success">
            <h6 class="my-0">Promo code</h6>
            <small>EXAMPLECODE</small>
          </div>
          <span class="text-success">-$5</span>
        </li>

        <li class="list-group-item d-flex justify-content-between">
          <span>Total (USD)</span>
          <strong><?php echo $lastOrder[$j]['cost_with_shipment'];?></strong>
        </li>
    <?php } }?>
	</div>
     <a class="btn btn-primary" href="#" style="color: white" id="more">More > ></a>
      </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div name="username" id="username" class="col-sm-9 text-secondary">
                      <?php echo($GLOBALS['client_info'][0]['username']);?> 
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div name="email" id="email" class="col-sm-9 text-secondary">
                      <?php echo($GLOBALS['client_info'][0]['email']);?> 
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div name="nu" id="nu" class="col-sm-9 text-secondary">
                      <?php echo($GLOBALS['client_info'][0]['nu']);?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">birthdate</h6>
                    </div>
                    <div name="birthdate" id="birthdate" class="col-sm-9 text-secondary">
                      <?php echo($GLOBALS['client_info'][0]['birthdate']);?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div name="client_location" id="client_location" class="col-sm-9 text-secondary">
                      <?php echo($GLOBALS['client_info'][0]['location']);?> 
                    </div>
                  </div>
                  <hr>             
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Work</h6>
                    </div>
                    <div name="work" id="work" class="col-sm-9 text-secondary">
                      <?php echo($GLOBALS['client_info'][0]['work']);?> 
                    </div>
                  </div>                  
                  <hr>             
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">About you</h6>
                    </div>
                    <div name="about_you" id="about_you" class="col-sm-9 text-secondary">
                      <?php 
                      rtrim($GLOBALS['client_info'][0]['about_you']);
                      echo preg_replace("/\r\n|\r|\n/", "<br>", $GLOBALS['client_info'][0]['about_you']);?> 
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info "name="edit_my_info" value="edit my info" id="edit_my_info">Edit</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">my purchases</i></h6>
                      <?php
                        $numOrder = getNumOrderTillNow($client_id);
                     	 ?>

                        <h6>My Purchase Quantity : <small class="text-secondary"><?php echo ($numOrder);?>order(s)</small></h6>

                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo ($numOrder);?>%" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>

                  
                    <!-- <h6>Purchase Quantity : <small class="text-secondary">92</small></h6>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>-->
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">My Sales</i></h6>
                      <?php
                      	$sumNumSellPro = getSumOfSoldProducts($client_id);
                      	$sumSoldPro = getAmountfItems($client_id);
                      	$cntMostSoldPro = getMostSoldProduct($client_id);
                      	$output = '';
                      	if($cntMostSoldPro!==NULL)
                      		$output = 'product name: '.$cntMostSoldPro[0]['pro_name'].'<br>num_sell: '.$cntMostSoldPro[0]['num_sell'].'<br>';
                      	else
                      		$output = 'no sold product yet..<br>';
                      ?>
                       <h6>Total quantity of sold items <small class="text-secondary"><?php echo $sumNumSellPro;?>item(s)</small></h6>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $sumNumSellPro;?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                     <h6>My Sales: <small class="text-secondary"><?php echo $sumSoldPro;?> SP</small></h6>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $sumSoldPro;?>%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                       <h6>most sold product: <small class="text-secondary"><?php echo $output;?></small></h6>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $output;?>%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      	<form id="edit_client_info" style="display: none;">

			<label for="edit_username">username </label>
			<input type="text" name="edit_username" id="edit_username" value="<?php echo($GLOBALS['client_info'][0]['username']);?>">

			<label for="edit_email">your email </label>
			<input type="text" name="edit_email" id="edit_email" value="<?php echo($GLOBALS['client_info'][0]['email']);?>">
			

			<label for="edit_password">your password</label>
			<input type="password" name="edit_password" id="edit_password" value="<?php echo($GLOBALS['client_info'][0]['password']);?>">
			
			<label for="edit_client_location">your location</label>
			<input type="text" name="edit_client_location" id="edit_client_location" value="<?php echo($GLOBALS['client_info'][0]['location']);?>">
			
			<label for="edit_nu">mobile number</label>
			<input type="text" name="edit_nu" id="edit_nu" value="<?php echo($GLOBALS['client_info'][0]['nu']);?>">

			<label for="edit_work">my work</label>
			<input type="text" name="edit_work" id="edit_work" value="<?php echo($GLOBALS['client_info'][0]['work']);?>">

			<label for="edit_about_you">about you</label>
			<textarea name="edit_about_you" id="edit_about_you" ><?php echo $GLOBALS['client_info'][0]['about_you'];?>
			</textarea>

			<input type="submit" name="edit" id="edit">

		</form>

		


<script type="text/javascript">

</script>
    <script src="../../../../code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.bundle.min.js"></script>
	</body>

	<ul class = "dropdown-menue">
      		
    </ul>
</html>