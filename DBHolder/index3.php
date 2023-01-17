<?php 
	require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Admin.php';
	require_once 'CompanyManager.php';
	require_once 'ClientManager.php';
	require_once 'DBManager.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>demo</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="jquery.tabledit.js"></script>
	

	<script type="text/javascript">
		$(document).ready(function(){
		$('#data_table').Tabledit({
		deleteButton: false,
		editButton: false,
		columns: {
		identifier: [0, 'order_id'],
		editable: [1, 'type_order'] 
		},
		hideIdentifier: true,
		url: 'live_edit.php'
		});
		})
	</script>
</head>
	<body>
		<table id="data_table" class="table table-striped">
	<thead>
	<tr>
	<th>order_id</th>
	<th>order_type</th>
	<th>smu</th>
	
	</tr>
	</thead>
	<tbody>
	<?php
	$shipment = new DBManager();
	$sql_query = $shipment->selectQuery("SELECT order_id, type_order, smu FROM shipment_bell LIMIT 10");
	$output = '';
		for($i=0;$i<sizeof($sql_query); $i++){
			$output.='<tr id="'.$sql_query[$i]['order_id'].'">';
			$output.='<td>'.$sql_query[$i]['order_id'].'</td>';
			$output.='<td>'.$sql_query[$i]['type_order'].'</td>';
			$output.='<td>'.$sql_query[$i]['smu'].'</td>';
		
		}
		echo $output;
	?>
	
	
	</tr>
	
	</tbody>
	</table>
	</body>
	</html>


	

