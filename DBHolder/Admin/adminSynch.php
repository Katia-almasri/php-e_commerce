<?php
	require_once '../CompanyManager.php';
	require_once '../ClientManager.php';
	require_once '../AdminManager.php';


	 function getTypeINFO($company_id, $type){
      $output = '';
      $company = new AdminManager();
     
        $com_info = $company->selectQuery("SELECT * FROM company WHERE com_id = '$company_id'");
        if($com_info!==NULL)
          {
            $output.='name: '.$com_info[0]['name'].'<br>email: '.
              $com_info[0]['email'];
          }
      
      return $output;
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
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
	<script type="text/javascript"></script>
	<script type="text/javascript">
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
	len = $('.notification-menu li').length;
	if(len==0){
		$('.notification-menu').empty();
	    $('.notification-menu').append(event);
	    
	}else{
		if(event!=='<li>no new notification</li>')
			{
				$('.notification-menu').empty();
				$('.notification-menu').append(event);
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
			if(event!=='no new clients')
				{
					$('.contacts-area mg-b-15').empty();
					$('.contacts-area mg-b-15').append(event);
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
url: "../remove.php",
 
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
url: "../removeCompanies.php",
 
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
url: "../removeClients.php",
 
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
url: "../removeAnn.php",
 
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
url: "../removeocassion.php",
 
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
url: "../load_shipment.php",
 
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
url: "../load_companies.php",

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
url: "../load_clients.php",

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
url: "../load_ocassions.php",

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
url: "../load_shipment.php",

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
url: "../load_announcment.php",

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
url: "../select.php",

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
		url: "../acceptproduct.php",
	 	data:{not_id:not_id},
		success: function(data){
		$('.notification-menu #'+not_id).remove();
}
});
	}
	</script>
 
</head>
<body>

</body>
</html>