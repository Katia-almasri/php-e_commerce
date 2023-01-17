<?php
	session_start();
	if(isset($_SESSION['client_id'])){
		
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
        $client_id = $_SESSION['client_id'];
		
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>comment</title>
	<script src="jquery.js">
		
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
		$("#add_comment").click(function(event){
			event.preventDefault();
		     comment = $("#comment").val();
			$.post("processComment.php", {
					comment:comment
			}, function(result){
					console.log(result);
					//window.setTimeout(function(){window.location.href="ajaxtest2.php";},3000);
			});

		});

		});
	</script>

</head>
<body>
	<form id="th" class="th">
		<textarea id="comment" name="aboutproduct"></textarea>
		<input type="submit" id="add_comment" class="add_comment" value="add comment">
	</form>
</body>
</html>