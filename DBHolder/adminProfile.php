<?php

	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Admin.php';
	require_once 'CompanyManager.php';
	require_once 'ClientManager.php';
	require_once 'AdminManager.php';
	//require_once 'adminstatistics.php';

	$email = '';
	$password = '';
	
	session_start();
	if(isset($_SESSION['email']))
	{
		
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
		
	}else{
		echo 'you dont have permission to login this page';
		echo '<a href="login.php">LOGIN </a>';
		exit();
			
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>admin profile</title>

	<script src="jquery.js">
	
	</script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
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
	#ann_count{
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

	#shipment_count
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

	.multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}

</style>
	<script type="text/javascript">

	var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

	 function addmsg(type, msg){
	 console.log(typeof msg);
 	 document.getElementById('notification_count').innerHTML=msg.unseen_notification;
}


function addship(type, ship){
	document.getElementById('shipment_count').innerHTML=ship.unseen_notification;
	

}

function addann(type, ann){
	document.getElementById('ann_count').innerHTML=ann.unseen_ann;
	//alert(ann.ann);
}

 
 function cutmsg(type, msg1){
	 var event = msg1.event;
	// document.getElementById('notification_count').innerHTML=msg1.unseen_notification;
	len = $('.dropdown-menue li').length;
	if(len==0){
		$('.dropdown-menue').empty();
	    $('.dropdown-menue').append(event);
	    
	}else{
		if(event!=='<li>no new notification</li>')
			{
				$('.dropdown-menue').empty();
				$('.dropdown-menue').append(event);
			}

	}

 	document.getElementById('notification_count').innerHTML=msg1.unseen_notification;
 
}


function cutcomp(type, company){
	var event = company.event;


len = $('.companies_menue li').length;
if(len==0){
	$('.companies_menue').empty();
    $('.companies_menue').append(event);
    
}else{
	if(event!=='<li>no new notification</li>')
		{
			$('.companies_menue').empty();
			$('.companies_menue').append(event);
		}

}

 }

		 function cutclient(type, client){
			var event = client.event;


		len = $('.clients_menue li').length;
		if(len==0){
			$('.clients_menue').empty();
		    $('.clients_menue').append(event);
		  
		}else{
			if(event!=='<li>no new notification</li>')
				{
					$('.clients_menue').empty();
					$('.clients_menue').append(event);
				}

		}

 }

 function cutocc(type, occ){
 	var event = occ.event;

 		
		len = $('#event-type option').length;
		if(len==0){
			
			$('#event-type').empty();
		    $('#event-type').append(event);
		  
		}else{
			
			if(event!=='<option>no ocassion</option>')
				{
					$('#event-type').empty();
					$('#event-type').append(event);
				}

		}	
 }

 function cutship(type, ship){
 	var event = ship.event;

 		//document.getElementById('shipment_count').innerHTML=ship.unseen_notification;
		len = $('.shipment_menue li').length;
		if(len==0){
			
			$('.shipment_menue').empty();
		    $('.shipment_menue').append(event);
		  
		}else{
			
			if(event!=='<li>no new shipment orders</li>')
				{
					$('.shipment_menue').empty();
					$('.shipment_menue').append(event);
				}

		}	
 }

 function cutann(type, ann){
 	var event = ann.ann;
 	
		len = $('.ann_notification li').length;
		if(len==0){
			
			$('.ann_notification').empty();
		    $('.ann_notification').append(event);
		  
		}else{
			
			if(event!=='<li>no new announcment orders</li>')
				{
					$('.ann_notification').empty();
					$('.ann_notification').append(event);
				}

		}	
 }

 function removeNotification(){

$.ajax({
type: "GET",
url: "remove.php",
 
async: true,
cache: false,
timeout:50000,
dataType:"json",
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


 function removeCompanies(){
 	$.ajax({
type: "GET",
url: "removeCompanies.php",
 
async: true,
cache: false,
timeout:50000,
dataType:"json",
success: function(data){
console.log(data);
cutcomp("new", data);
setTimeout(
waitForCompanies,
1000
);

}
});
 }


  function removeClients(){
 	$.ajax({
type: "GET",
url: "removeClients.php",
 
async: true,
cache: false,
timeout:50000,
dataType:"json",
success: function(data){
console.log(data);
cutclient("new", data);
setTimeout(
waitForClients,
1000
);

}
});
 }

 function removeAnnounment(){
 	$.ajax({
type: "GET",
url: "removeAnn.php",
 
async: true,
cache: false,
timeout:50000,
dataType:"json",
success: function(data){
console.log(data);
cutann("new", data);
setTimeout(
waitForAnn,
1000
);

}
});
 }


function removeOcassion(){
	$.ajax({
type: "GET",
url: "removeocassion.php",
 
async: true,
cache: false,
timeout:50000,
dataType:"json",
success: function(data){
console.log(data);
cutocc("new", data);
setTimeout(
waitForOcassions,
1000
);

}
});
}


function removeShipment(){
	$.ajax({
type: "GET",
url: "load_shipment.php",
 
async: true,
cache: false,
timeout:50000,
dataType:"json",
success: function(data){
console.log(data);
cutship("new", data);
setTimeout(
removeShipment,
1000
);

}
});
}

 function waitForCompanies(){
 	$.ajax({
method: "GET",
url: "load_companies.php",

async: true,
cache: false,
timeout:50000,
dataType:"json", 

success: function(data){

setTimeout(
waitForCompanies,
1000
);
},
error: function(XMLHttpRequest, textStatus, errorThrown){

setTimeout(
waitForCompanies,
15000);
}

});
 }


  function waitForClients(){
 	$.ajax({
method: "GET",
url: "load_clients.php",

async: true,
cache: false,
timeout:50000,
dataType:"json", 

success: function(data){

setTimeout(
waitForClients,
1000
);
},
error: function(XMLHttpRequest, textStatus, errorThrown){

setTimeout(
waitForClients,
15000);
}

});
 }

 function waitForOcassions(){
 	$.ajax({
method: "GET",
url: "load_ocassions.php",

async: true,
cache: false,
timeout:50000,
dataType:"json", 

success: function(data){

setTimeout(
waitForOcassions,
1000
);
},
error: function(XMLHttpRequest, textStatus, errorThrown){

setTimeout(
waitForOcassions,
15000);
}

});
 }


 function waitForShipment(){
 	$.ajax({
method: "GET",
url: "load_shipment.php",

async: true,
cache: false,
timeout:50000,
dataType:"json", 

success: function(data){

addship("new", data);
setTimeout(
waitForShipment,
1000
);
},
error: function(XMLHttpRequest, textStatus, errorThrown){
addship("error", textStatus + " (" + errorThrown + ")");

setTimeout(
waitForShipment,
15000);
}

});
 }


 function waitForAnn(){
 	$.ajax({
method: "GET",
url: "load_announcment.php",

async: true,
cache: false,
timeout:50000,
dataType:"json", 

success: function(data){

addann("new", data);
setTimeout(
waitForAnn,
1000
);
},
error: function(XMLHttpRequest, textStatus, errorThrown){
addann("error", textStatus + " (" + errorThrown + ")");

setTimeout(
waitForAnn,
15000);
}

});
 }

function waitForMsg(){

$.ajax({
method: "GET",
url: "select.php",

async: true,
cache: false,
timeout:50000,
dataType:"json", 

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


	function updateAfterAccept(not_id){
		$.ajax({
		type: "GET",
		url: "acceptproduct.php",
	 	data:{not_id:not_id},
		success: function(data){
		$('#'+not_id).remove();
		alert(data);

}
});
	}
 

		$(document).ready(function(){
			waitForMsg();
			waitForCompanies();
			waitForClients();
			waitForOcassions();
			waitForShipment();
			waitForAnn();
			
			 $('#notificationLink').click(function(event){

			 	event.preventDefault();
			 	removeNotification();
			 });

			 $('#add-occasion').click(function(event){

			 	event.preventDefault();
			 	$('#occasion').show();
			 });

			 $('#add_occasion').click(function(event){
			 	event.preventDefault();
			 	var name = $('#occasion_name').val();
			 	$.post("addoccasion.php", {
			 		name:name
			 	}, 
			 	function(result){
			 		alert(result);
			 		$('#occasion').css('display', 'none');
			 	}
			 	);
			 });


			////////////////////////////////////////////////////
			var cnt_companies = 0;
			var cnt_clients = 0;
			var cnt_ship = 0;
		

		 $('#shipment_not').click(function(event){
				event.preventDefault();
				cnt_ship = cnt_ship+2;
				$(".shipment_menue").load("removeshipment.php", {
				cnt_ship:cnt_ship
				},
				function(result){
					//alert(result);
					$('.shipment_menue').empty();
	   				 $('.shipment_menue').append(result);
	   				 removeShipment();

				}
				);
			});


		$(".dropdown-menue").mouseover(function(){
			$(".accept").unbind("click");
			$(".accept").click(function(event){
					event.preventDefault();
					var not_id = $(this).attr('id');
					updateAfterAccept(not_id);
					removeNotification();
				});

		});

		$(".dropdown-menue").mouseover(function(){
			$(".refuse").unbind("click");
			$(".refuse").click(function(event){
					event.preventDefault();
						not_id = $(this).attr('id');
					$.ajax({
						type:'GET',
						url:'refuseproduct.php', 
						data:{not_id:not_id},
						success:function(result){
							alert(result);
							$('#'+not_id).remove();
							removeNotification();
							//document.getElementById("admin_action").innerHTML = result;
						}
					});
				});

		});


		$('#company').click(function(event){
			event.preventDefault();
			cnt_companies = cnt_companies+2;
			$(".companies_menue").load("load_some_companies.php", {
			cnt_companies:cnt_companies
			},
			function(result){
				//alert(result);
				$('.companies_menue').empty();
   				 $('.companies_menue').append(result);
   				 removeShipment();
			}
			);
			});	
		
		$('#client').click(function(event){
			event.preventDefault();
			cnt_clients = cnt_clients+2;
			$(".clients_menue").load("load_some_client.php", {
					cnt_clients:cnt_clients
			}, 
			function(result){
				$('.clients_menue').empty();
   				 $('.clients_menue').append(result);

			}
			);


				
			});	

		$(".clients_menue").mouseover(function(){
			$(".email").unbind("click");
			$(".email").click(function(event){
					event.preventDefault();
				
				});

		});
		
		$(".clients_menue").mouseover(function(){
			$(".delete").unbind("click");
			$(".delete").click(function(event){
					event.preventDefault();
						client_id = $(this).attr('id');
					$.ajax({
						type:'post',
						url:'delete_client.php', 
						data:{client_id:client_id},
						success:function(result){
							$('#'+client_id).remove();
							removeClients();
						}
					});
				});

		});



		$(".companies_menue").mouseover(function(){
			$(".email").unbind("click");
			$(".email").click(function(event){
					event.preventDefault();
					alert($(this).attr('id'));
				});

		});
		
		$(".companies_menue").mouseover(function(){
			$(".delete").unbind("click");
			$(".delete").click(function(event){
					event.preventDefault();
					company_id = $(this).attr('id');
					alert(company_id);
					$.ajax({
						type:'post',
						url:'delete_company.php', 
						data:{company_id:company_id},
						success:function(result){
							$('#'+company_id).remove();
							removeCompanies();
						}

					});
				});
			});

		$("#ann_not").click(function(event){
			event.preventDefault();
			removeAnnounment();
		});

		$(".ann_notification").mouseover(function (){
			$(".launch_announcement").unbind("click");
			$(".launch_announcement").click(function(event){
					event.preventDefault();
					ann_ord_id = $(this).attr('id');
					alert(ann_ord_id);
					$.ajax({
						type:'post',
						url:'acceptAnn.php', 
						data:{ann_ord_id:ann_ord_id},
						success:function(result){
							$('#'+ann_ord_id).remove();
							removeAnnounment();
							//alert(result);
						}

					});
				});
		});

		$(".ann_notification").mouseover(function (){
			$(".reject_announcement").unbind("click");
			$(".reject_announcement").click(function(event){
					event.preventDefault();
					ann_ord_id = $(this).attr('id');
					alert(ann_ord_id);
					$.ajax({
						type:'post',
						url:'rejectAnn.php', 
						data:{ann_ord_id:ann_ord_id},
						success:function(result){
							$('#'+ann_ord_id).remove();
							removeAnnounment();
							alert(result);
						}

					});
				});
		});

		

		$("#launch_event").click(function(event){
			event.preventDefault();
			removeOcassion();
			$('#event').show();

		});


			var selectionState = false;
			$('.type').click(function(){
				//alert('here');
				if($('.type').is(":checked")){
					$('.selectBox').css('display', 'none');
				}else{
					$('.selectBox').show();
				}
			});

			/*$('#asd').click(function(){
				
				if($('#asd').is(":checked")){
					$('#cl_com').css('display', 'none');
				}else{
					$('#cl_com').show();
				}
			});*/

			$('#launch').click(function(event){
				event.preventDefault();
				
				 array = [];
			 $("input[class='pro_options']:checked").each(function(){
            array.push(this.value);
        });

			
			console.log(array);

			 selectedEvent  = $('#event-type').find(":selected").attr('id');
			console.log(selectedEvent);
			 types = [];
			  $("input[class='type']:checked").each(function(){
            types.push(this.value);
        });
			
			console.log(types);
			 dis_com = $('#dis_com').val();
			 dis_cl = $('#dis_cl').val();
			 
			if(selectionState===false){
				//not select client or company
				 dis_pro = $('#dis_pro').val();
				
			}
			
			 start_day = $('#start_date').val();
			 end_day = $('#end_date').val();
			
			var formData = $(this).serializeArray();
			var a_string = JSON.stringify(array);
			formData.push({name: 'array1', value: a_string});
			var t_string = JSON.stringify(types);
			formData.push({name: 'array2', value: t_string});

			var form_data ={
				"a":JSON.stringify(array),
				"t":JSON.stringify(types), 
				"discountPro":dis_pro,
				"discountCom":dis_com, 
				"discountCl":dis_cl, 
				"selectionState":selectionState,
				"st_date":start_day, 
				"ed_date":end_day, 
				"selectedEvent":selectedEvent

			};

			$.ajax({

				type: "POST",
				url: "launch_event.php",
			 	data:{
			 		
				a:array,
				t:types, 
				discountPro:dis_pro,
				discountCom:dis_com, 
				discountCl:dis_cl, 
				selectionState:selectionState,
				st_date:start_day, 
				ed_date:end_day, 
				selectedEvent:selectedEvent

			
			 	},
			 	
				success: function(data){
		
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
       <a href="#" id="company" ><i class="fa fa-bell" aria-hidden="true" style="position: relative;left: 60px;font-size: 30px;color:yellow;"></i></a>
       <a href="#" id="add-occasion" ><i class="fa fa-bell" aria-hidden="true" style="position: relative;left: 60px;font-size: 30px;color:green;"></i></a>
        <a href="#" id="client" ><i class="fa fa-bell" aria-hidden="true" style="position: relative;left: 60px;font-size: 30px;color:black;"></i></a>
        <a href="#" id="launch_event" ><i class="fa fa-bell" aria-hidden="true" style="position: relative;left: 60px;font-size: 30px;color:orange;"></i></a>
        <span id="shipment_count" class="ship"></span>
         <a href="#" id="shipment_not" ><i class="fa fa-bell" aria-hidden="true" style="position: relative;left: 60px;font-size: 30px;color:pink;"></i></a>
         <span id="ann_count" class="ann"></span>
         <a href="#" id="ann_not" ><i class="fa fa-bell" aria-hidden="true" style="position: relative;left: 60px;font-size: 30px;color:gray;"></i></a>
         
    </div>
    <ul class="nav navbar-nav">
     
      <li><a href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    	 <li class="dropdown"><a href="#" class = "dropdown-toggle" data-toggle="dropdown" id="show-companies">companies</a>
    	 	<ul class = "companies_menue">
      		
      		</ul>
    	 </li>
    	 
      <li><a href="#"><span class="label label-pill label-danger count"></span> Notification</a>
      	<ul class = "dropdown-menue">
      		
      	</ul>
      </li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> clients</a>
      			<ul class = "clients_menue">
      		
      			</ul>
      </li>

       <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> ocassion</a>
      			<ul class = "ocassion_menue">
      		
      			</ul>
      	</li>
      	<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> shipment notification</a>
      			<ul class = "shipment_menue">
      		
      			</ul>

      </li>

      	<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> announcment notification</a>
      			<ul class = "ann_notification">
      		
      			</ul>

      </li>
    </ul>
  </div>

  <div id="statis">

  </div>
</nav>

<form id="occasion" style="display: none;">
	<label for="occasion_name">occasion name</label>
	<input type="text" name="occasion_name" id="occasion_name">
	<button type="submit" name="add_occasion" id="add_occasion" >add</button>
</form>

<form id="event" style="display: none;">
	
	<label for="event-type">event type</label>
	<select id="event-type" name="event-type">
		<?php
			//for each event in product table
			$output = '';
			$admin = new AdminManager();
			$options = $admin->selectQuery("SELECT * FROM ocaasion");
			if($options!==NULL){
				for($i=0;$i<sizeof($options); $i++){
					$output.='<option id="'.$options[$i]['occ_id'].'"value="'.$options[$i]['occasion_name'].'">'.$options[$i]['occasion_name'].'</option>';

				}
			}
			echo $output;
			
		?>	
	</select>
	<div id="cl_com" >
		<label for="ch_com">company</label>
		<input type="checkbox" name="ch_com" id="ch_com" class="type" value="company">
		<label for="dis_com">discount percent for companies</label>
		<input type="text" name="dis_com" id="dis_com">
		<label for="ch_cl">client</label>
		<input type="checkbox" name="ch_cl" id="ch_cl" class="type" value="client">
		<label for="dis_cl">discount percent for clients</label>
		<input type="text" name="dis_com" id="dis_cl">
	</div>

	<div id="pro">
	<div class="multiselect">
    <div class="selectBox" onclick="showCheckboxes()">
      <select id="asd">
        <option>Select products</option>
      </select>
      <div class="overSelect"></div>
    </div>
    <div id="checkboxes">
    	<?php
    	$output = '';
			$admin = new AdminManager();
			$products = $admin->selectQuery("SELECT * FROM product");
			//print_r($products);
			echo sizeof($products);
			if($products!==NULL){
				for($i=0; $i<sizeof($products); $i++){
					$output.='<label for="'.$products[$i]['name'].'">';
					$output.='<input class ="pro_options" type="checkbox" id="'.$products[$i]['pro_id'].'"value="'.$products[$i]['pro_id'].'"/>'.$products[$i]['name'].'</label>';
				}
			}
			echo $output;
			
     
        ?>
    </div>
  </div>

	
	<label for="dis_pro">discount percent on products</label>
	<input type="text" name="dis_pro" id="dis_pro">
	</div>

	<label for="start_date">start day event</label>
	<input type="date" name="start_date" id="start_date" value="">

	<label for="end_date">end day event</label>
	<input type="date" name="end_date" id="end_date" value="">

	<button type="submit" name="launch" id="launch" >launch</button>

	
</form>

</body>
</html>