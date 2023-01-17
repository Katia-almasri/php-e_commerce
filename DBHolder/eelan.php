<?php
	require_once 'DBManager.php';
	require_once 'ProductManager.php';

	$manager = new ProductManager();
	$result = $manager->selectQuery("SELECT * FROM time_an");
	$finalRes = json_encode($result);
	


?>
<!DOCTYPE html>
<html>
<head>
	<title>announcement</title>
	<script src="jquery.js">
		
		</script>
</head>
<body>
	<form id="ann">
			
			<label for="start_ann">
				start of announcement
			</label>
			<input type="date" name="start_ann" id="start_ann">

			<select id="time_An" name="time_An">
				
			</select>
			
			<input type="submit" name="add_ann" id="add_ann" value="Accept announcement">
			
		</form>

		<form id="ann_image" enctype = "multipart/form-data" method="POST" action="">
			<img src="" id="img" width="100" height="100" class="des-Img">

			<input type="file" name="uploadImage" id="uploadImage" >
			<input type="button" name="Upload" id="Upload" value="add image">
		</form>

		<script type="text/javascript">
			
				let time_ann = JSON.parse('<?php echo $finalRes;?>');
						
						//creatig dynamic options
						for(let i =0; i<time_ann.length;++i){
							
						let op = document.createElement("option");
							op.value = time_ann[i].type;
							op.text='time: '+time_ann[i].type+', cost: '+time_ann[i].cost+'$';
							op.id = time_ann[i].time_an_id;
							document.getElementById("time_An").appendChild(op);
						}
			 $(document).ready(function(){
			selectedImageURL = 'annImage/defaultProduct.png';
			$('#img').attr("src", selectedImageURL);
			$('.des-Img').show();
			

		

			 $('#Upload').click(function(){
					event.preventDefault();
					var fd = new FormData();
					var files = $('#uploadImage')[0].files;
					console.log(files[0].name);
					if(files.length>0){
						fd.append('uploadImage', files[0]);
						$.ajax({
							url:'addannImage.php', 
							type:'post', 
							data:fd, 
							contentType:false, 
							processData:false, 
							success:function(response){
								if(response!==0 && response!=='the image should be(1920 X 325)'){
									alert('done');
									$('#img').attr("src", response);
									$('.des-Img').show();
									selectedImageURL = response.replace(/(?:\\[rn]|[\r\n]+)+/g, "");
									selectedImageURL = encodeURIComponent(selectedImageURL);
									console.log(selectedImageURL);

								}else{
									alert(response);
								}
							} 
						});
					}else{
						alert('please select an image');
					}
				});

			 });


			

		</script>
		
</body>
</html>