<?php



?>

<!DOCTYPE html>

<html>
	<head>
		<title>
			login company form
		</title>
		
		<script
		src="https://code.jquery.com/jquery-3.6.0.min.js"
		integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
		crossorigin="anonymous">
		</script>
		
		<script>
			$(document).ready(function(){
				$("#login").click(function(event){
					event.preventDefault();
					name = $("#name").val(), 
					$.post("checkLogin.php",{name:name},function(data){
						if(data==='Wrong name'){
							document.getElementById("resultlogin-form").innerHTML = data+' <br>Dont have a company account?<a href="companyAccount.php">sign in now</a>';
							
						}else{
							document.getElementById("resultlogin-form").innerHTML = data;
							window.setTimeout(function(){window.location.href="ajaxtest1.php?id="+data;}, 1000);
						}
						
					});
				});
				
			});
		</script>
	</head>
	
	<body>
		<form id="company-form">
			<label for="name">
				company name
			</label>
			
			<input type="text" name="name" id="name" value="">
			<input type="submit" name="login" id="login" value="login">
		</form>
		
		<div id="resultlogin-form">
		
		</div>
	</body>
</html>