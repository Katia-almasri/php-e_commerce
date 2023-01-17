<?php
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	require_once 'CompanyManager.php';
	



?>

<!DOCTYPE html>
<html>
<head>
	<title>testFilter</title>

	<script src="jquery.js">
		
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
				
	$(".f").on('click', function(event){
		event.preventDefault();
		var filterAs = $(this).attr("id");
		alert(filterAs);
			$.ajax({
						type:'post',
						url:'filter.php', 
						data:{f:filterAs},
						success:function(result){
							$("#result").text('');
							$("#result").text(result);
						}
					});
		
	});
	

});

	
				
	</script>
	
	
</head>
<body>
	<div>
		<button>Filter</button>
		<div>
			
			<a href = "#"class ="f" id="date_of_expose">
				date_of _expose
			</a>

			<a href = "#"class ="f" id="cost">
				cost
			</a>

			<a href = "#"class ="f" id="num_sell">
			   number of sells
			</a>

			<a href = "#"class ="f" id="num_likes">
			   number of likes
			</a>

			<a href = "#"class ="f" id="category">
			   category
			</a>

			
		</div>
	</div>

	<div id="result">
	</div>


</body>
</html>