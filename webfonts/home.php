<?php
require "../DBHolder/DBManager.php";
require "functions.php";
session_start();

$_SESSION['user_id'] = 67;
$_SESSION['user_type'] = 'client';
$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

$num_products_on_each_page = 20;

if (isset($_GET['page'])) {
    echo $page=$_GET['page'];
  
}
  else{
    $page=1;
  }
  
if(isset($_GET['per_page'])){
  $per_page=$_GET['per_page'];
}

else {
  $per_page=2;
}

$start = $per_page * $page - $per_page;


if (isset($_GET['search'])){
  $products = get_products_by_search($_GET['search']);
}

else if (isset($_POST['search'])) {
  $products = get_products_by_search($_POST['search']);
}

else if (isset($_GET['category'])){
  $cat = $_GET['category'];
  echo $_GET['category'];
  $pdo = pdo_connect_mysql();
  $stmt7 = $pdo->prepare("SELECT * FROM (((procomp p inner join product pr on pr.pro_id=p.pro_id) 
   inner join item_cat c on c.item_id=pr.item_id )inner join category cat on cat.cat_id=c.cat_id ) where c.cat_id='$cat'union all SELECT * FROM (((proclient cl inner join product pr on pr.pro_id=cl.pro_id) 
   inner join item_cat c on c.item_id=pr.item_id )inner join category cat on cat.cat_id=c.cat_id)where c.cat_id='$cat' ");
  $stmt7->execute();
  $products = $stmt7->fetchAll(PDO::FETCH_ASSOC);
   $total_products = $pdo->query('SELECT * FROM procomp')->rowCount();

}
  else if(isset($_GET['WishList'])){
    $pdo = pdo_connect_mysql();
    if($user_type==='client')
   {$stmt4 = $pdo->prepare("SELECT w.*,p.name FROM wishlist w inner join product p on w.pro_id=p.pro_id WHERE client_id = '$user_id';");
     $stmt4->execute();

     $products = $stmt4->fetchAll(PDO::FETCH_ASSOC);}
     else{
      $products = [];
     }
  }

else {
  $pdo = pdo_connect_mysql();
  $stmt = $pdo->prepare("SELECT * FROM procomp UNION ALL SELECT * FROM 
    proclient ORDER BY date_of_expose DESC LIMIT {$start},{$per_page}");
  $stmt->execute();
  $date_of_expose1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $total_products = $pdo->query('SELECT * FROM procomp')->rowCount();


   $stmt1 = $pdo->prepare("SELECT * FROM procomp UNION ALL SELECT * FROM 
    proclient ORDER BY cost DESC LIMIT  8 ");
   $stmt1->execute();
    $cost1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    $stmt5 = $pdo->prepare("SELECT * FROM procomp UNION ALL SELECT * FROM 
    proclient ORDER BY num_sell DESC LIMIT 8");
   $stmt5->execute();
    $num_sell1 = $stmt5->fetchAll(PDO::FETCH_ASSOC);

    $stmt6 = $pdo->prepare("SELECT * FROM procomp UNION ALL SELECT * FROM 
    proclient ORDER BY num_likes DESC LIMIT 8");
   $stmt6->execute();
    $num_likes1 = $stmt6->fetchAll(PDO::FETCH_ASSOC);
}
?>


<?= template_header('home') ?>

<!--           second navs   ******  !-->

<nav class="navbar navbar-expand-xl navbar-light  bg-light   sec_nav text-primary">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>


  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="nav navbar-nav">
      <div id="mysidenav" class="sidenav">
        <a href="#" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="home.php?category=1">food</a>
        <a href="home.php?category=2">furniture</a>
        <a href="home.php?category=3">technology</a>
        <a href="home.php?category=4">drink</a>
        <a href="home.php?category=5">clothes</a>
      </div>

     <div id="main">
        <span onclick="openNav()">
          &#9776;
        </span>
      </div>
      <li class=" nav-item nav-link text-primary " href="#"><i class="fas fa-medal"></i> Best Seller
      </li>
      <li class="nav-item nav-link text-primary" href="#"><i class="fas fa-concierge-bell"></i> Customer Service
      </li>

      <li class="nav-item nav-link text-primary" ><i class="fas fa-medal"></i><a href="#date_of_expose2"> By Date of expose</a>
      </li>
      <li class="nav-item nav-link text-primary" ><i class="fas fa-medal"></i><a href="#cost2"> cost</a>
      </li>
      <li class="nav-item nav-link text-primary" href="#"><i class="fas fa-camera"></i> <a href="#num_sell1"> num sell</a>
      </li>
      <li class="nav-item nav-link text-primary" href="#"><i class="fas fa-football-ball"></i> <a href="num_likes1"> num likes</a>
      </li>
      </li>
      <li class="nav-item nav-link text-primary" ><i class="fas fa-heart"></i><a href="home.php?WishList"> WishList</a> 
      </li>
      <li class="nav-item nav-link text-primary" href="#"><i class="fas fa-laptop"></i> Smart Device
      </li>
      <li class="nav-item nav-link text-primary" href="#"><i class="fas fa-book"></i> Books
      </li>
      <li class="nav-item nav-link text-primary" href="#"><i class="fas fa-gamepad"></i> Games & Toys
      </li>
      <li class="nav-item nav-link ml-auto  " href="comment.html"><a href="contact us/contactus.php" style="color: darkgray"><i class="fas fa-comments"></i> Give US Your Opinion</a>
      </li>
    </ul>
  </div>
</nav>


<!--         test section   ********* !-->
<marquee scrolldelay="0" width="1540px" height="35px" direction="left" bgcolor="#009dff" align="middle">
  <h5 style="color: azure; font-family: montserrat; font-size: 25px;font-weight: bold"> Sign up in our website and get a special deal ! &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; lasna alwahedon laknna al2afdal !! &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Visit our new section : mazad </h5>
</marquee>

<!--             الإعلانات      *************!-->
<!-- 1920 X 325 ابعاد الصورة حصرا !-->
<section id="test">
  <div id="carouselExample1" class="carousel slide z-depth-1-half" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="imgs/1.png" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="imgs/2.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="imgs/3.jpg" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExample1" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExample1" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

</section>


<!--         product section   ********* !-->

<?php
if(!isset($_GET['category']) && !isset($_GET['search'])&&!isset($_POST['search']) && !isset($_GET['WishList'])) :
 if (count($date_of_expose1) == 0) : ?>
<center>Sorry...There are no products to show</center>
<?php endif; ?>
<section id="product">
  <div class="row">
    <?php $count = 0;
    foreach ($date_of_expose1 as $product) : ?>
      <div class="col-lg-3 col-md-4 col-sm-12" style="padding-bottom:2%">
        <div class="card" data-id="<?= $count ?>">
          <?php $count++; ?>
          <!-- يجب اضافة صورة المنتج هنا   ****!-->
          <a href = "product.php?id=<?=$product["pro_id"]?>"><img src="../DBHolder/<?= $product['image'] ?>" class="card-img-top" alt="..."></a>
          <div class="card-body">
            <h4 class="card-title"><?= $product['pro_name'] ?>
              <!--اسم المنتج-->
            </h4>
            <h1 class="card-title pricing-card-title"><small class="text-muted">&dollar;<?= $product['cost'] - (($product['discount_percent'] / 100) * $product['cost']) ?></small>
              <?php if ($product['discount_percent'] > 0) : ?>
                <span><strike><small class="text-muted">&dollar;<?= $product['cost'] ?></small></strike></span>
              <?php endif; ?>
            </h1>
            <!-- مواصفات المنتج الخاصة ***!-->
            <?php
            $rate = (int)($product['rate']);           // The rate without the decimal part
            for ($i = 0; $i < $rate; $i++) : ?>
              <i class="fa fa-star"></i>
            <?php endfor; ?>
            <?php if (is_float($product['rate'])) :     // If the rate has a decimal part them we should add a half star ?>
              <i class="fas fa-star-half"></i>
            <?php endif; ?>
          </div>
          <div class="card-footer">
            <form class="form-submit">
              <input type="hidden" name="product_id" id="product_id" value="<?= $product['pro_id'] ?>">
              <input type="hidden" name="quantity" id="quantity" value="1">
              <div class="buttons"> <button id="addItem" class="cart-button b"> <span class="add-to-cart">AddToCart</span> <span class="added">Done !</span>
                  <i class="fa fa-shopping-cart"></i> </button>
                  <button><img src="buttons/wishlist-icon1.jpg" /></button>
            </form>
          </div>

          <!--  <a type="button" href="#"  class="btn btn-sm  btn-outline-primary "> <i class="fas fa-info"></i></a>!-->
        </div>
      </div>
    
  </div>
<?php endforeach;

 ?>

 <br>
 <nav>
  </nav>
<hr>
 </div>
</section>

<h4>coooooooooooooooooooost</h4>


<section id="product">
  <div class="row">
<?php 
if (count($cost1) == 0) : ?>
<center>Sorry...There are no products to show</center>
<?php endif; 
 foreach ($cost1 as $product) : ?>
      <div class="col-lg-3 col-md-4 col-sm-12" style="padding-bottom:2%">
        <div class="card" data-id="<?= $count ?>">
          <?php $count++; ?>
          <!-- يجب اضافة صورة المنتج هنا   ****!-->
          <a href = "product.php?id=<?=$product["pro_id"]?>"><img src="../DBHolder/<?= $product['image'] ?>" class="card-img-top" alt="..."></a>
          <div class="card-body">
            <h4 class="card-title"><?= $product['pro_name'] ?>
              <!--اسم المنتج-->
            </h4>
            <h1 class="card-title pricing-card-title"><small class="text-muted">&dollar;<?= $product['cost'] - (($product['discount_percent'] / 100) * $product['cost']) ?></small>
              <?php if ($product['discount_percent'] > 0) : ?>
                <span><strike><small class="text-muted">&dollar;<?= $product['cost'] ?></small></strike></span>
              <?php endif; ?>
            </h1>
            <!-- مواصفات المنتج الخاصة ***!-->
            <?php
            $rate = (int)($product['rate']);           // The rate without the decimal part
            for ($i = 0; $i < $rate; $i++) : ?>
              <i class="fa fa-star"></i>
            <?php endfor; ?>
            <?php if (is_float($product['rate'])) :     // If the rate has a decimal part them we should add a half star ?>
              <i class="fas fa-star-half"></i>
            <?php endif; ?>
          </div>
          <div class="card-footer">
            <form class="form-submit">
              <input type="hidden" name="product_id" id="product_id" value="<?= $product['pro_id'] ?>">
              <input type="hidden" name="quantity" id="quantity" value="1">
              <div class="buttons"> <button id="addItem" class="cart-button b"> <span class="add-to-cart">AddToCart</span> <span class="added">Done !</span>
                  <i class="fa fa-shopping-cart"></i> </button>
                  <button><img src="buttons/wishlist-icon1.jpg" /></button>
            </form>
          </div>
          <!--  <a type="button" href="#"  class="btn btn-sm  btn-outline-primary "> <i class="fas fa-info"></i></a>!-->
        </div>
      </div>
  </div>
<?php
endforeach; 

 ?>
  <br>
<nav>
  
</nav>
<hr>
 </div>
</section>

<h4>numsell</h4>


<section id="product-3">
  <div class="row">
<?php 
if (count($num_sell1) == 0) : ?>
<center>Sorry...There are no products to show</center>
<?php endif; 
 foreach ($num_sell1 as $product) : ?>
      <div class="col-lg-3 col-md-4 col-sm-12" style="padding-bottom:2%">
        <div class="card" data-id="<?= $count ?>">
          <?php $count++; ?>
          <!-- يجب اضافة صورة المنتج هنا   ****!-->
          <a href = "product.php?id=<?=$product["pro_id"]?>"><img src="../DBHolder/<?= $product['image'] ?>" class="card-img-top" alt="..."></a>
          <div class="card-body">
            <h4 class="card-title"><?= $product['pro_name'] ?>
              <!--اسم المنتج-->
            </h4>
            <h1 class="card-title pricing-card-title"><small class="text-muted">&dollar;<?= $product['cost'] - (($product['discount_percent'] / 100) * $product['cost']) ?></small>
              <?php if ($product['discount_percent'] > 0) : ?>
                <span><strike><small class="text-muted">&dollar;<?= $product['cost'] ?></small></strike></span>
              <?php endif; ?>
            </h1>
            <!-- مواصفات المنتج الخاصة ***!-->
            <?php
            $rate = (int)($product['rate']);           // The rate without the decimal part
            for ($i = 0; $i < $rate; $i++) : ?>
              <i class="fa fa-star"></i>  
            <?php endfor; ?>
            <?php if (is_float($product['rate'])) :     // If the rate has a decimal part them we should add a half star ?>
              <i class="fas fa-star-half"></i>
            <?php endif; ?>
          </div>
          <div class="card-footer">
            <form class="form-submit">
              <input type="hidden" name="product_id" id="product_id" value="<?= $product['pro_id'] ?>">
              <input type="hidden" name="quantity" id="quantity" value="1">
              <div class="buttons"> <button id="addItem" class="cart-button b"> <span class="add-to-cart">AddToCart</span> <span class="added">Done !</span>
                  <i class="fa fa-shopping-cart"></i> </button>
                  <button><img src="buttons/wishlist-icon1.jpg" /></button>
            </form>
          </div>
          <!--  <a type="button" href="#"  class="btn btn-sm  btn-outline-primary "> <i class="fas fa-info"></i></a>!-->
        </div>
      </div>
  </div>
<?php
endforeach; 

 ?>
<nav>
  
</nav>
<hr>
 </div>
</section>

<h4>numlike</h4>


<section id="product-4">
  <div class="row">
<?php 
if (count($num_likes1) == 0) : ?>
<center>Sorry...There are no products to show</center>
<?php endif; 
 foreach ($num_likes1 as $product) : ?>
      <div class="col-lg-3 col-md-4 col-sm-12" style="padding-bottom:2%">
        <div class="card" data-id="<?= $count ?>">
          <?php $count++; ?>
          <!-- يجب اضافة صورة المنتج هنا   ****!-->
          <a href = "product.php?id=<?=$product["pro_id"]?>"><img src="../DBHolder/<?= $product['image'] ?>" class="card-img-top" alt="..."></a>
          <div class="card-body">
            <h4 class="card-title"><?= $product['pro_name'] ?>
              <!--اسم المنتج-->
            </h4>
            <h1 class="card-title pricing-card-title"><small class="text-muted">&dollar;<?= $product['cost'] - (($product['discount_percent'] / 100) * $product['cost']) ?></small>
              <?php if ($product['discount_percent'] > 0) : ?>
                <span><strike><small class="text-muted">&dollar;<?= $product['cost'] ?></small></strike></span>
              <?php endif; ?>
            </h1>
            <!-- مواصفات المنتج الخاصة ***!-->
            <?php
            $rate = (int)($product['rate']);           // The rate without the decimal part
            for ($i = 0; $i < $rate; $i++) : ?>
              <i class="fa fa-star"></i>
            <?php endfor; ?>
            <?php if (is_float($product['rate'])) :     // If the rate has a decimal part them we should add a half star ?>
              <i class="fas fa-star-half"></i>
            <?php endif; ?>
          </div>
          <div class="card-footer">
            <form class="form-submit">
              <input type="hidden" name="product_id" id="product_id" value="<?= $product['pro_id'] ?>">
              <input type="hidden" name="quantity" id="quantity" value="1">
              <div class="buttons"> <button id="addItem" class="cart-button b"> <span class="add-to-cart">AddToCart</span> <span class="added">Done !</span>
                  <i class="fa fa-shopping-cart"></i> </button>
                  <button><img src="buttons/wishlist-icon1.jpg" /></button>
            </form>
          </div>
          <!--  <a type="button" href="#"  class="btn btn-sm  btn-outline-primary "> <i class="fas fa-info"></i></a>!-->
        </div>
      </div>
  </div>
<?php
endforeach; 
endif;
 ?>
 <div class="table-responsive" id="pagination_data">  
 </div> 
<nav>
 
</nav>
<hr>
 </div>
</section>


<?php
if(isset($_GET['category']) ||  isset($_GET['search']) || isset($_POST['search']) || isset($_GET['WishList'])) :
 if (count($products) == 0) : ?>
<center>Sorry...There are no products to show</center>
<?php endif; ?>
<section id="product">
  <div class="row">
    <?php $count = 0;
    foreach ($products as $product) : ?>
      <div class="col-lg-3 col-md-4 col-sm-12" style="padding-bottom:2%">
        <div class="card" data-id="<?= $count ?>">
          <?php $count++; ?>
          <!-- يجب اضافة صورة المنتج هنا   ****!-->
          <a href = "product.php?id=<?=$product["pro_id"]?>"><img src="imgs/products/<?= $product['image'] ?>" class="card-img-top" alt="..."></a>
          <div class="card-body">
            <h4 class="card-title"><?= $product['pro_name'] ?>
              <!--اسم المنتج-->
            </h4>
            <h1 class="card-title pricing-card-title"><small class="text-muted">&dollar;<?= $product['cost'] - (($product['discount_percent'] / 100) * $product['cost']) ?></small>
              <?php if ($product['discount_percent'] > 0) : ?>
                <span><strike><small class="text-muted">&dollar;<?= $product['cost'] ?></small></strike></span>
              <?php endif; ?>
            </h1>
            <!-- مواصفات المنتج الخاصة ***!-->
            <?php
            $rate = (int)($product['rate']);           // The rate without the decimal part
            for ($i = 0; $i < $rate; $i++) : ?>
              <i class="fa fa-star"></i>
            <?php endfor; ?>
            <?php if (is_float($product['rate'])) :     // If the rate has a decimal part them we should add a half star ?>
              <i class="fas fa-star-half"></i>
            <?php endif; ?>
          </div>
          <div class="card-footer">
            <form class="form-submit">
              <input type="hidden" name="product_id" id="product_id" value="<?= $product['pro_id'] ?>">
              <input type="hidden" name="quantity" id="quantity" value="1">
              <div class="buttons"> <button id="addItem" class="cart-button b"> <span class="add-to-cart">AddToCart</span> <span class="added">Done !</span>
                  <i class="fa fa-shopping-cart"></i> </button>
                  <button><img src="buttons/wishlist-icon1.jpg" /></button>
            </form>
          </div>
          <!--  <a type="button" href="#"  class="btn btn-sm  btn-outline-primary "> <i class="fas fa-info"></i></a>!-->
        </div>
      </div>
  </div>
<?php endforeach;
?>
<nav>
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item "><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">4</a></li>
    <li class="page-item"><a class="page-link" href="#">5</a></li>
    <li class="page-item"><a class="page-link" href="#">6</a></li>
    <li class="page-item"><a class="page-link" href="#">7</a></li>
    <li class="page-item"><a class="page-link" href="#">8</a></li>
    <li class="page-item"><a class="page-link" href="#">9</a></li>
    <li class="page-item"><a class="page-link" href="#">10</a></li>

    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
<hr>
<?php
endif; ?>


<script type="text/javascript">
  $(document).ready(function() {
    $(document).on("click", "#addItem", function(e) {
      e.preventDefault();

      var form = $(this).closest(".form-submit");
      var pro_id = form.find("#product_id").val();
      var quantity = form.find("#quantity").val();
      alert(quantity+' '+pro_id );
      $.ajax({
        url: "CartAndCheckout.php",
        method: "post",
        data: {
          product_id: pro_id,
          quantity: quantity
        },
        success: function(response) {
          alert(response);
          $(".alert-message").html(response);
        }
      });
    });

      load_data_1();  
      function load_data_1(page)  
      {  
           $.ajax({  
                url:"pagination.php",  
                method:"POST",  
                data:{page:page},  
                success:function(data){  
                     $('#product').html(data);  
                }  
           })  
      }  
      $(document).on('click', '.pagination_link_pl_1', function(){  
           var page = $(this).attr("id");  
           load_data_1(page);  
      });

      load_data_2();  
      function load_data_2(page)  
      {  
           $.ajax({  
                url:"pagination_2.php",  
                method:"POST",  
                data:{page:page},  
                success:function(data){  
                     $('#product').html(data);  
                }  
           })  
      }  
      $(document).on('click', '.pagination_link_pl_2', function(){  
           var page = $(this).attr("id");  
           load_data_2(page);  
      });  
 });  
 
</script>



<script>
  document.addEventListener("DOMContentLoaded", function(event) {
    const cartButtons = document.querySelectorAll('.cart-button');
    cartButtons.forEach(button => {
      button.addEventListener('click', cartClick);
    });

    function cartClick() {
      let button = this;
      button.classList.add('clicked');
    }
  });
</script>

<script>
  function openNav() {
    document.getElementById('mysidenav').style.width = "250px";
    document.getElementById('main').style.width = "250px";
  }

  function closeNav() {
    document.getElementById('mysidenav').style.width = "0px";
    document.getElementById('main').style.width = "0px";
  }
</script>

<script>
  var cartButtons = document.querySelectorAll('.cart-button');
  var card_value = document.querySelector(".added");

  cartButtons.forEach(button => {
    button.addEventListener('click', cartClick);

  });

  function cartClick() {
    let button = this;
    button.classList.add('clicked');
  }
</script>


<script>
  const likeBtn = document.querySelector(".like__btn");
  let likeIcon = document.querySelector("#icon"),
    count = document.querySelector("#count");

  let clicked = false;


  likeBtn.addEventListener("click", () => {
    if (!clicked) {
      clicked = true;
      likeIcon.innerHTML = `<i class="fas fa-heart"></i>`;
      count.textContent++;
    } else {
      clicked = false;
      likeIcon.innerHTML = `<i class="far fa-heart"></i>`;
      count.textContent--;
    }
  });
</script>

<script>
  const likeBtn1 = document.querySelector(".like__btn_");
  let likeIcon1 = document.querySelector("#icon1"),
    count1 = document.querySelector("#count1");
  let clicked1 = false;

  likeBtn1.addEventListener("click", () => {
    if (!clicked1) {
      clicked1 = true;
      likeIcon1.innerHTML = `<i class="fas fa-save"></i>`;
      count1.textContent++;
    } else {
      clicked1 = false;
      likeIcon1.innerHTML = `<i class="far fa-save"></i>`;
      count1.textContent--;
    }
  });
</script>



<?= template_footer() ?>


<script src="../../../../code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script>
  window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
</script>
<script src="../../dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>