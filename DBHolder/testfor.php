<?php
require_once 'C:\xampp\htdocs\phpsandbox\E_Commerce\Includes\Product.php';
	require_once 'ProductManager.php';
	require_once 'ClientManager.php';
	
	session_start();
	if(isset($_SESSION['email']))
	{
		
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
		
		
	
	}else{
		echo 'you dont have permission to login this page';
		echo '<a href="login.php">LOGIN </a>';
			
	}


 	$client = new ClientManager();
		$clientPro = $client->getAllProductsBelongToClient($email, $password);
		$products = $clientPro->fetch_assoc;
		echo $products;

?>
<!DOCTYPE html>
<html>
<head>
	<title>
		test pro
	</title>

	<link href="style.css" rel="stylesheet">   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php foreach ($clientPro as $product): ?>
	<div class="col-lg-2 col-md-4 col-sm-12">
                <div class="card">
      <!-- يجب اضافة صورة المنتج هنا   ****!-->
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><?php $product.pro_name?>   <!--اسم المنتج-->  </h5>
        <h1 class="card-title pricing-card-title">$12</h1>
        <!-- مواصفات المنتج الخاصة ***!-->
      <p class="card-text">Some Details </p>
        <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemax="100">20%</div>
</div>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fas fa-star-half"></i>
    </div>
    <div class="card-footer">
    
      <a type="button" href="#"  class="btn btn-sm  btn-outline-primary "> <i class="fas fa-info"> Add to card</i></a>
    </div>
  </div>
 </div>
 <?php endforeach; ?>
              <script>
        document.addEventListener("DOMContentLoaded", function(event) {


const cartButtons = document.querySelectorAll('.cart-button');

cartButtons.forEach(button => {

button.addEventListener('click',cartClick);

});

function cartClick(){
let button =this;
button.classList.add('clicked');
}



});
        </script>
</body>
</html>


 
