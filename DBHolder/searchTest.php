<?php



?>
<!DOCTYPE html>
<html>
<head>
	<title>search test</title>
	<script src="jquery.js">
	</script>

	<script type="text/javascript">
		
		function suggest(suggestion){
			if(suggestion.length==0)
				document.getElementById('result-suggest').innerHTML = ' ';
			else{

				$.post('processSearch.php' , {
					suggestion:suggestion
				}, function(result){
					document.getElementById('result-suggest').innerHTML = '';
					document.getElementById('result-suggest').innerHTML = result;
				});
			}

		}

		$(document).ready(function(){
			$("#submit-search").click(function(event){
				event.preventDefault();
				var suggestion = $("#search-box").val();
				alert(suggestion);
			});
		});
	</script>
</head>
<body>
	<form id="search-form" method="POST" action='processSearch.php'>
		<input type="text" name="search-box" id="search-box" onkeyup="suggest(this.value)">
		<input type="submit" name="submit-search" id="submit-search">
	</form>

	<div id="result-suggest">

	</div>
</body>
</html>