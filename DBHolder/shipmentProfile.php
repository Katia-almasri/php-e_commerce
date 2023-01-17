<?php
	
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Admin.php';
	require_once 'CompanyManager.php';
	require_once 'ClientManager.php';
	require_once 'DBManager.php';
	require_once 'auxFunctions.php';

	$email = '';
	$shipment_name = '';
	$shipment_id = '';
	session_start();
	if(isset($_SESSION['email']))
	{
		
		$email = $_SESSION['email'];
		$shipment_id = $_SESSION['shipment_id'];
		
		
	}else{
		echo 'you dont have permission to login this page';
		echo '<a href="login.php">LOGIN </a>';
		exit();
			
	}

	$shipment = new DBManager();
	


?>

<!DOCTYPE html>
<html>
<head>
	<title>shipment profile</title>
	<script src="jquery.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			    $(".done_com_class").click(function(event){
			   	event.preventDefault();
			    done_com_class = $(this).attr('id');
			    alert(done_com_class);
			 	ch = 0;
			 	is_arrived_com = $('.is_arrived_com').attr('id');
			 	alert(is_arrived_com);
			 	if( $("#"+is_arrived_com).attr("checked", true)){
			 		ch = 1;
			 		alert(ch);
			 	}
			 	
			 	$.ajax({
						type:'post',
						url:'processIsArrive.php', 
						data:{ch:ch,
							ord_type_id:is_arrived_com,
							type:'company'
						},
						success:function(result){
							alert(result);
							$('.com_ord#'+done_com_class).remove();
							
						}

					});

			 });

			   $(".done_client_class").click(function(event){
			   	event.preventDefault();
			    done_client_class = $(this).attr('id');
			    alert(done_client_class);
			 	ch = 0;
			 	is_arrived_client = $('.is_arrived_client').attr('id');
			 	alert(is_arrived_client);
			 	if( $("#"+is_arrived_client).attr("checked", true)){
			 		ch = 1;
			 		alert(ch);
			 	}
			 	
			 	$.ajax({
						type:'post',
						url:'processIsArrive.php', 
						data:{ch:ch,
							ord_type_id:is_arrived_client,
							type:'client'
						},
						success:function(result){
							alert(result);
							$('.client_ord#'+done_client_class).remove();
							
						}

					});

			 });
 
			
		});

	</script>



</head>
<body>

		<nav class="navbar navbar-inverse">
		 <div class="container-fluid">
		 	<div class="navbar-header">
		 		<span id="notification_count" class="noti"></span>
    			  <a href="#" id="notificationLink" ><i class="fa fa-bell" aria-hidden="true" style="position: relative;left: 60px;font-size: 30px;"></i></a>
		 	</div>
		 	<ul class="nav navbar-nav navbar-right">
		 		 <li><a href="#"><span class="label label-pill label-danger count"></span> Notification</a>
      				<ul class = "dropdown-menue-1">
      					|Company Order Queue|
      					<form>
      						<ul class="company_list">
      							<?php 
      								$company_orders = $shipment->selectQuery("SELECT * FROM order_comp WHERE is_seen = 0");
      								if($company_orders!==NULL){
      									for($i=0; $i<sizeof($company_orders); $i++){

      							?>
      							<li id="<?php echo($company_orders[$i]['order_id']);?>" class="com_ord">
      								order id: <?php echo ($company_orders[$i]['order_id']);?><br>
      								date of order: <?php echo ($company_orders[$i]['date_order']);?><br>
      								tot cost: <?php echo ($company_orders[$i]['tot_cost']);?><br>
      								type of paid: <?php echo ($company_orders[$i]['type_paid']);?><br>
      								number of items: <?php echo ($company_orders[$i]['items_num']);?><br>
      								sum of items weight: <?php echo ($company_orders[$i]['sum_item_weight']);?><br>
      								shipment cost: <?php echo ($company_orders[$i]['shipment_cost']);?><br>
      								total cost should company pay(with shipment): <?php echo ($company_orders[$i]['cost_with_shipment']);?><br>
      								MORE DETAIL ABOUT ITEMS:<br>
      							  	<?php  $item_component = getItems($company_orders[$i]['order_id'], 'company');
								        if(!empty($item_component)){
								        for($j = 0; $j<sizeof($item_component); $j++){
								            
								    ?>
								    product name: <?php echo $item_component[$j]['product_name'];?><br>
								    product type <?php echo $item_component[$j]['type'];?><br>
								    cost <?php echo $item_component[$j]['cost'];?><br>
								    amount <?php echo $item_component[$j]['amount'];?><br>
								    total cost <?php echo $item_component[$j]['tot_cost'];?><br>
								    MORE DETAIL ABOUT PRODUCER:<br>
								    <?php $info = getProducerINFO('procomp', $item_component[$j]['type_id']);
								    	for($k = 0; $k<sizeof($info); $k++){
								    		if($item_component[$j]['type']==='procomp'){
								    ?>
								    company:<?php echo $info[$k]['name'];?><br>
								    branch:<?php echo $info[$k]['branch'];?><br>
								    location:<?php echo $info[$k]['location'];?><br>
								    email:<?php echo $info[$k]['email'];?><br>
								  
									<?php
									  }

								else{ ?>
									client name:<?php echo $info[$k]['username'];?><br>
									location:<?php echo $info[$k]['location'];?><br>
									email:<?php echo $info[$k]['email'];?><br>
									mobile number:<?php echo $info[$k]['nu'];?><Br>
									
									<?php } } } }?>
									<label for="<?php echo($company_orders[$i]['order_id']);?>">
										is order arrive
									</label>
      					<input type="checkbox" class = "is_arrived_com" id="<?php echo($company_orders[$i]['order_id']);?>" name="is_arrived" value="is_arrive" >
									<input type="submit" name="done" id="<?php echo($company_orders[$i]['order_id']);?>" class="done_com_class">
      							</li>
      						<?php }?>
      							
      					<?php  }?>
      						</ul>
      					</form>
      				</ul>


      				|Client Order Queue|
      				<ul id="dropdown-menue-2">
      					<form>
      						<ul for="client_list">
      							<?php 
      								$client_orders = $shipment->selectQuery("SELECT * FROM order_client WHERE is_seen = 0");
      								if($client_orders!==NULL){
      									for($i=0; $i<sizeof($client_orders); $i++){

      							?>
      							<li id="<?php echo($client_orders[$i]['order_id']);?>" class="client_ord">
      								order id: <?php echo ($client_orders[$i]['order_id']);?><br>
      								date of order: <?php echo ($client_orders[$i]['date_order']);?><br>
      								tot cost: <?php echo ($client_orders[$i]['tot_cost']);?><br>
      								type of paid: <?php echo ($client_orders[$i]['type_paid']);?><br>
      								number of items: <?php echo ($client_orders[$i]['items_num']);?><br>
      								sum of items weight: <?php echo ($client_orders[$i]['sum_item_weight']);?><br>
      								shipment cost: <?php echo ($client_orders[$i]['shipment_cost']);?><br>
      								total cost should client pay(with shipment): <?php echo ($client_orders[$i]['cost_with_shipment']);?><br>
      								MORE DETAIL ABOUT ITEMS:<br>
      							  	<?php  $item_component = getItems($client_orders[$i]['order_id'], 'client');
								        if(!empty($item_component)){
								        for($j = 0; $j<sizeof($item_component); $j++){
								            
								    ?>
								    product name: <?php echo $item_component[$j]['product_name'];?><br>
								    product type <?php echo $item_component[$j]['type'];?><br>
								    cost <?php echo $item_component[$j]['cost'];?><br>
								    amount <?php echo $item_component[$j]['amount'];?><br>
								    total cost <?php echo $item_component[$j]['tot_cost'];?><br>
								    MORE DETAIL ABOUT PRODUCER:<br>
								    <?php $info = getProducerINFO('procomp', $item_component[$j]['type_id']);
								    	for($k = 0; $k<sizeof($info); $k++){
								    		if($item_component[$j]['type']==='procomp'){
								    ?>
								    company:<?php echo $info[$k]['name'];?><br>
								    branch:<?php echo $info[$k]['branch'];?><br>
								    location:<?php echo $info[$k]['location'];?><br>
								    email:<?php echo $info[$k]['email'];?><br>
								  
									<?php
									  }

								else{ ?>
									client name:<?php echo $info[$k]['username'];?><br>
									location:<?php echo $info[$k]['location'];?><br>
									email:<?php echo $info[$k]['email'];?><br>
									mobile number:<?php echo $info[$k]['nu'];?><Br>
									<?php } } } }?>
									
									<label for="<?php echo($client_orders[$i]['order_id']);?>">
										is order arrive
									</label>
      					<input type="checkbox" class = "is_arrived_client" id="<?php echo($client_orders[$i]['order_id']);?>" name="is_arrived" value="is_arrive" >
									<input type="submit" name="done" id="<?php echo($client_orders[$i]['order_id']);?>" class="done_client_class">
      							</li>
      							<?php }?>
      						
      					<?php  }?>
      						</ul>
      					</form>
      				</ul>
      			</li>

      			 <li><a href="#"><span class="label label-pill label-danger count"></span> company order queue</a>
      				<ul class = "dropdown-menue-company-order">
      					<form>

      						<ul>
      							
      								
      						</ul>
      					</form>
      				</ul>

      			 <li><a href="#"><span class="label label-pill label-danger count"></span> client order queue</a>
      				<ul class = "dropdown-menue-client-order">
      					<form>
      						<ul>
      							
      								
      						</ul>
      					</form>
      				</ul>
      			</li>
		 	</ul>
		 </div>
	</nav>
</body>
</html>