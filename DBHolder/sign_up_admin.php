<?php
	
	session_start();
	if(isset($_SESSION['admin_id'])){
		
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
		$admin_id = $_SESSION['admin_id'];
		
		

	}
	

?>

<!DOCTYPE html>

<html>
	<head>
	 <title>
		admin account
	 </title>
	 
	<script src="jquery.js">
	
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
		$('#login_in_addmin').click(function(event){
			event.preventDefault();
			email = $("#email").val(); 
			password = $("#password").val();

			$.post("admin.php", {
				email:email, 
				password:password
										
				}, function(result){
					if(result!==''){
						document.getElementById("msg").innerHTML = result;
					}
					else{
						window.setTimeout(function(){window.location.href="adminProfile.php";},3000);
					}
				}
						
						
			);
			
		}
		);
	});
	</script>

	<form>
		<label for="email">
			admin email
		</label>
		<input type="text" name="email" id="email">

		<label for="password">
			admin password
		</label>
		<input type="password" name="password" id="password">
		<input type="button" id="login_in_addmin" name="login" value="submit">
	</form>
	<div id = "msg">
		
	</div>

		
	</head>
	
	<body>
		
	</body>
</html>