	

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
