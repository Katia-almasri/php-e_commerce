<?php
	
	session_start();
	if(isset($_SESSION['shipment_id'])){
		
		$email = $_SESSION['email'];
		$shipment_id = $_SESSION['shipment_id'];
		$shipment_name = $_SESSION['shipment_name'];
	
	}
	

?>

<!DOCTYPE html>

<html>
	<head>
	 <title>
		shipment account
	 </title>
	 
	<script src="jquery.js">
	
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
		$('#login_shipment').click(function(event){
			event.preventDefault();
			email = $("#email").val(); 
			shipment_name = $("#name").val();

			$.post("shipment.php", {
				email:email, 
				shipment_name:shipment_name
										
				}, function(result){
					if(result!==''){
						document.getElementById("msg").innerHTML = result;
					}
					else{
						window.setTimeout(function(){window.location.href="shipmentProfile.php";},2000);
					}
				}
						
						
			);
			
		}
		);
	});
	</script>

	<form>
		<label for="email">
		 email
		</label>
		<input type="text" name="email" id="email">

		<label for="name">
			shipment name
		</label>
		<input type="text" name="name" id="name">
		<input type="button" id="login_shipment" name="login" value="submit">
	</form>
	<div id = "msg">
		
	</div>

		
	</head>
	
	<body>
		
	</body>
</html>