    
<?php
	
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	require_once 'CompanyManager.php';
	require_once 'companystatistics.php';

	$email = '';
	$psd = '';
	$com_id = 0;
	session_start();
	if(isset($_SESSION['psd']))
	{ 
		
		$email = $_SESSION['email'];
		$psd = $_SESSION['psd'];
		
		
	
	}else{
		echo 'you dont have permission to login this page';
		echo '<a href="login.php">LOGIN </a>';
		exit();
			
	}
	
	$company = new CompanyManager();	
	$companyINFO = $company->selectQuery("SELECT * FROM company WHERE email= '$email'");
	$GLOBALS['company_info'] = $companyINFO;
	$GLOBALS['company_pro'] = '';
	$_SESSION['com_id'] = $companyINFO[0]['com_id'];
	$com_id = $_SESSION['com_id'];
	
	 function getcompanyINFO($email){
	 	$company = new CompanyManager();	
		$companyINFO = $company->selectQuery("SELECT * FROM company WHERE email='$email'");
		$output = '';
		$output.="<div id='company_info'>";
		$output.="name: ".$companyINFO[0]['name'].'<br>';
		if($companyINFO[0]['branch']!=='')
			$output.='branch: '.$companyINFO[0]['branch'].'<br>';
		$output.="location: ".$companyINFO[0]['location'].'<br>';
		if($companyINFO[0]['date_launch']!==NULL)
			$output.="date of launch: ".$companyINFO[0]['date_launch']."<br>";
		if($companyINFO[0]['lisence_number']!==NULL)
			$output.="lisence number: ".$companyINFO[0]['lisence_number']."<br>";
		$output.="owner: ".$companyINFO[0]['owner'].'<br>email: '.$companyINFO[0]['email'].'<br>';
		$about_us = preg_replace( "/\r|\n/", "<br>", $companyINFO[0]['about_us']);
		$output.="about us: ".$about_us."<br>";
		$output.='</div>';
		return $output; 

	 }

	 function showAllProducts($email, $psd){
	 	$company = new CompanyManager();
	 	$products = $company->getAllProductsBelongToCompany($email, $psd);
	 	$output = '';
	 	if($products!==NULL)
	 		{
	 			$GLOBALS['company_pro'] = $products;
	 			for($i=0;$i<sizeof($products);$i++){
	 				$procomp_id = $products[$i]['procomp_id'];
	 				$img = $products[$i]['image'];
	 				preg_replace( "/\r|\n/", "", $img);
	 				$output.="<div id='$procomp_id'>";
	 				$output.="<img src='$img' id='img_pro' width='100' height='100' class='des-Img'>";
	 				$description = preg_replace( "/\r|\n/", "<br>", $products[0]['description']);
	 				$output.='about product: '.$description.'<br>';
	 				$output.='product name: '.$products[$i]['pro_name'].'<br>amount: '.$products[$i]['amount'].'<br>cost: '.$products[$i]['cost'].'<br>production date: '.$products[$i]['production_date'].'<br>';
	 				$output.="<input type='button' id='$procomp_id' class='edit_pro' value='edit'>";
	 				$output.="<input type='button' id='$procomp_id' class='remove_pro' value='remove'></div>";
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
			Company Profile
		</title>
		<script src="jquery.js">
		
		</script>
		<script src="https://kit.fontawesome.com/c83b2f6af9.js" crossorigin="anonymous"></script>
		<script type="text/javascript">

	function cutpro(type, pro){
		console.log(pro);
		var products = pro.products;

		$("#pro_char").empty();
		$("#pro_char").html(products);
			

	}

	function waitForNewProducts(com_id){
		$.ajax({
		method: "POST",
		url: "loadCompanyProducts.php",

		async: true,
		cache: false,
		timeout:50000,
		dataType:"json", 
		data:{com_id:com_id},
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

	function removeProducts(com_id){
		$.ajax({
			type: "GET",
			url: "removeProduct.php",
			 
			async: true,
			cache: false,
			timeout:50000,
			dataType:"json",
			date:{com_id:com_id},
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

	 <meta charset="utf-8">
   
    <title>bs4 Profile with dashboard - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bs4_profiles.css" rel="stylesheet">
    <link rel="stylesheet" href="Admin/css/educate-custon-icon.css">
        <link rel="stylesheet" href="Admin/css/responsive.css">

        <link rel="shortcut icon" type="image/x-icon" href="Admin/img/favicon.ico">
            <link rel="stylesheet" href="Admin/css/font-awesome.min.css">


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
				$(document).ready(function(){
				var	cnt_order = 0;
				//variables to edit 
				var rate = 0.00;
				var production_date = '';
				var amount = 0;
				var cost = 0;
				var image = '';
				var procomp_id = 0;

		waitForNewProducts("<?php echo($companyINFO[0]['com_id']);?>");
		image_pro = 'procomp/defaultProduct.png';
		$("#img").attr("src", "<?php echo($companyINFO[0]['image']);?>");
		$("#company_name").html("<?php echo($companyINFO[0]['name']);?>");

		$("#about_us").click(function(event){
			event.preventDefault();
			alert('<?php echo($email);?>');
			$("#company_name").empty();
			$("#company_name").append("<?php echo getcompanyINFO($email);?>".replace(/(\r\n|\n|\r)/gm, "<br>"));
			 	
		});

		$("#edit_our_info").click(function(){
			$("#edit_com_info").show();
		});

		$("#edit").click(function(event){
			event.preventDefault();
			name =  $("#name").val();
			email =  $("#email").val();
			password =  $("#password").val();
			com_location =  $("#com_location").val();
			owner =  $("#owner").val();
			branch =  $("#branch").val();
			about_us =  $("#about_us").val();
			about_us =about_us.replace(/\"/g, "").replace(/\'/g, "");
			alert(name+', '+com_location);

			 	$.ajax({
					type: "POST",
					url: "editProfile.php",
					data:{
						name:name, 
						email:email,
						password:password,
						com_location:com_location, 
						owner:owner,
						branch:branch, 
						about_us:about_us
					},
					success: function(data){
					alert(data);
					$("#edit_com_info").css('display', 'none');
					
					}
					});


		});

		$("#add_product").click(function(event){
			event.preventDefault();
			window.location.href="addProduct.php";
		});

		$('#Upload').click(function(){
					event.preventDefault();
					var fd = new FormData();
					var files = $('#uploadImage')[0].files;
					console.log(files[0].name);	
					if(files.length>0){
						fd.append('uploadImage', files[0]);
						$.ajax({
							url:'addImage.php', 
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
								}else{
									alert(response);
								}
							} 
						});
					}else{
						alert('please select an image');
					}
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
							url:'addProductImage.php', 
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
			 procomp_id = $(this).attr('id');
			console.log(procomp_id);
			$("#editedPro").show();
			$("#image_pro").show();
			 rate_old = $('#'+procomp_id+' #rate').html();
			 production_date_old = $('#'+procomp_id+' #production_date').html();
			 amount_old = $('#'+procomp_id+' #amount').html();
			 cost_old = $('#'+procomp_id+' #cost').html();
			 image_old = $('#'+procomp_id+' .image').attr('src');
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
					url: "processProduct.php",
					dataType:'json',
					data:{
						rate:rate, 
						production_date:production_date,
						amount:amount,
						cost:cost, 
						image:image, 
						procomp_id:procomp_id
						
					},
					success: function(data){
					if(data!==true){
						$("#editedPro").css('display', 'none');
						$("#image_pro").css('display', 'none');
						alert(data);
						$('#'+procomp_id+' #production_date').html(data.production_date);
						$('#'+procomp_id+' #rate').html(data.rate);
						$('#'+procomp_id+' #cost').html(data.cost);
						$('#'+procomp_id+' #amount').html(data.amount);
						$('#'+procomp_id+' .image').attr('src', data.image);
					}else{
						alert('wrong input!!');
					}
				}
					});
		});

		$(".delete").click(function(event){
			event.preventDefault();
			procomp_id = $(this).attr('id');
			console.log(procomp_id);
			$.ajax({
						type:'POST',
						url:'deleteProduct.php', 
						data:{procomp_id:procomp_id},
						success:function(result){
							alert(result);
							$('#'+procomp_id).remove();
							removeProducts(procomp_id);
							
						}
					});

		});

		$("#more").click(function(event){
			event.preventDefault();
			cnt_order = cnt_order+1;
			$("#con").load("load_last_order_com.php", {
			cnt_order:cnt_order,
			com_id:"<?php echo($com_id);?>"
			},
			function(result){
				alert(result);
				$('#con').empty();
   				$('#con').append(result);

   				 
			}
			);
			});
		
	});
		</script>
		
	</head>
		
<body>

		<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- meta -->
                <div class="profile-user-box card-box bg-custom">
                    <div class="row">
                        <div class="col-sm-6"><span class="float-left mr-3">
                            
                            
                            
                            <!--************************add logo                   -->
                            <img src="<?php echo($GLOBALS['company_info'][0]['image']);?>" alt="" class="thumb-lg rounded-circle"></span>
                            <div class="media-body text-black">
                                <h4 class="mt-1 mb-1 font-40 "><?php echo($GLOBALS['company_info'][0]['name']);?></h4>
                                <p class="mt-1 mb-1 font-18">Address : <?php echo($GLOBALS['company_info'][0]['location']);?></p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-right">
                                    
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ meta -->
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-xl-4">
                <!-- Personal-Information -->
                <div class="card-box">
                    <h4 class="header-title mt-0">Company Information</h4>
                    <div class="panel-body">
                        <p class="text-muted font-13">About us : <?php echo($GLOBALS['company_info'][0]['about_us']);?> </p>
                        <hr>
                        <div class="text-left">
                            <p class="text-muted font-13"><strong>Name of company : </strong> <span class="m-l-15"><?php echo($GLOBALS['company_info'][0]['name']);?></span></p>
                            <p class="text-muted font-13"><strong>Name of owner : </strong><span class="m-l-15"><?php echo($GLOBALS['company_info'][0]['owner']);?></span></p>
                            <p class="text-muted font-13"><strong>Email : </strong> <span class="m-l-15"><?php echo($GLOBALS['company_info'][0]['email']);?></span></p>
                            <p class="text-muted font-13"><strong>Location : </strong> <span class="m-l-15"><?php echo($GLOBALS['company_info'][0]['location']);?></span></p>
                             <p class="text-muted font-13"><strong>Lisence number : </strong> <span class="m-l-15"><?php echo($GLOBALS['company_info'][0]['lisence_number']);?></span></p>
                            <p class="text-muted font-13"><strong>Branch : </strong> <span class="m-l-5"><span class="flag-icon flag-icon-us m-r-5 m-t-0" title="us"></span> <span><?php echo($GLOBALS['company_info'][0]['branch']);?></span> </span>
                            <p class="text-muted font-13"><strong>Date launch : </strong> <span class="m-l-5"><span class="flag-icon flag-icon-us m-r-5 m-t-0" title="us"></span> <span><?php echo($GLOBALS['company_info'][0]['date_launch']);?></span> </span>
                            </p>
                        </div>
                        <button class="btn btn-outline-primary btn-sm">Edit</button>
                        <br>
                        <br>
                        <button class="btn btn-outline-primary btn-sm"> <a href="addProduct.php">Add product</a></button>
                        <button class="btn btn-outline-primary btn-sm"><a href="eelan.php">Add ads</a></button>
                        
                    </div>
                </div>
                <!-- Personal-Information -->


         <div class="card mt-3">
        <h3 class="text-center">
        <span class="text-muted ">The value of the last bill</span>
         </h3>
      <ul class="list-group mb-3">
      	<div id="con">
      	<?php 

      		$company = new CompanyManager();
      		$lastOrder = $company->selectQuery("SELECT * FROM order_comp WHERE comp_id = '$com_id' ORDER BY date_order DESC LIMIT 1");
      		if($lastOrder!==NULL){
      			for($j=0; $j<sizeof($lastOrder); $j++){
      			$items = getItems($lastOrder[0]['order_id'], 'company');
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
            <div class="col-xl-8">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card-box tilebox-one"><i class="icon-layers float-right text-muted"></i>
                        <?php
                        $numOrder = getNumOrderTillNow($com_id);
                        $numsell = getNumsell($com_id);
                        $revenue = REVENUE($com_id);
                     	 ?>
                            <h6 class="text-muted text-uppercase mt-0">Orders</h6>
                            <h2 class="" data-plugin="counterup"><?php echo ($numOrder); ?> </h2><span class="text-muted"></span></div>
                    </div>
                    <!-- end col -->
                    <div class="col-sm-4">
                        <div class="card-box tilebox-one"><i class="icon-paypal float-right text-muted"></i>
                            <h6 class="text-muted text-uppercase mt-0">Revenue</h6>
                            <h2 class=""><span data-plugin="counterup"><?php echo ($revenue); ?></span>$</h2></span><span class="text-muted"></span></div>
                    </div>
                    <!-- end col -->
                    <div class="col-sm-4">
                        <div class="card-box tilebox-one">
                            <h6 class="text-muted text-uppercase mt-0">Product Sold</h6>
                            <h2 class="" data-plugin="counterup"><?php echo ($numsell); ?></h2><span class="text-muted"></span></div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
                <div class="card-box">
                    <div class="row">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Purchases</i></h6>
                      <?php
                        $numpro = getNumproduct($com_id);

                     	 ?>
                        <h6>number of my products : <small class="text-secondary"><?php echo ($numpro);?> product(s)</small></h6>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo ($numpro);?>%" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      
                     
                   
                    </div>
                  </div>
                </div>
                                        <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Purchases</i>Project Status</h6>
                      <?php
                      	
                      	$cntMostSoldPro = getMostSoldProduct($com_id);
                      	$output = '';
                      	if($cntMostSoldPro!==NULL)
                      		$output = 'product name: '.$cntMostSoldPro[0]['pro_name'].'<br>num_sell: '.$cntMostSoldPro[0]['num_sell'].'<br>';
                      	else
                      		$output = 'no sold product yet..<br>';
                      ?>
                        <h6>most sold product: <small class="text-secondary"><?php echo $output;?></small></h6>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $output;?>%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    
                     
                   
                      
                    </div>
                  </div>
                </div>
                    </div>
                    
                </div>
                <div class="card-box">
                    <h4 class="header-title mb-3">My Products</h4>
<div class="table-wrapper-scroll-y my-custom-scrollbar">
  <table class="table table-bordered table-striped mb-0">
    <thead>
     <tr>
                                        
                                        <th>Name of Company</th>
                                        <th>Amount</th>
                                        <th>Cost</th>
                                        <th>Rate</th>
                                        <th>Number sell</th>
                                        <th>Current amount</th>
                                        <th>Setting</th>
       </tr>
    </thead>
    <tbody>

      <?php
                                        $company = new CompanyManager();
                                        $procomp = $company->selectQuery("SELECT * FROM procomp WHERE com_id = '$com_id'");
                                        if($procomp!==NULL){
                                            for($i=0; $i<sizeof($procomp); $i++){


                                    ?>

                                    <tr id="<?php echo $procomp[$i]['procomp_id'];?>">
                                        <td><?php echo $procomp[$i]['pro_name'];?></td>
                                        
                                        <td>
                                           <?php echo $procomp[$i]['amount'];?>
                                        </td>
                                        <td><?php echo $procomp[$i]['cost'];?></td>
                                        <td><?php echo $procomp[$i]['rate'];?></td>
                                        <td><?php echo $procomp[$i]['num_sell'];?></td>
                                        <td><?php echo $procomp[$i]['cur_amount'];?></td>
                                        <td><div class="row " style="margin-left: 10px">
                                        	<a class="btn btn-sm btn-primary delete" id="<?php echo $procomp[$i]['procomp_id'];?>"style=""><i class="fas fa-pen"></i> </a>
                                            <a class="btn btn-sm btn-primary edit" style=""><i class="fas fa-envelope-square"></i></a>

                                        </td>
                                    </tr>
                                    <?php  }
                                        }
                                        ?>


 

   
    </tbody>
  </table>

</div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- container -->
</div>

<style type="text/css">

</style>

<script type="text/javascript">

</script>
	</body>
</html>