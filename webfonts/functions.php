<?php
require_once "../DBHolder/DBManager.php";

function get_products_by_search($pro_name)
{
  $pdo  = pdo_connect_mysql();
  $stmt = $pdo->prepare('SELECT * FROM procomp WHERE pro_name LIKE :term UNION ALL SELECT * FROM proclient WHERE pro_name LIKE :term');
  $term = '%' . $pro_name . '%';
  $stmt->bindParam(':term', $term);
  $stmt->execute();
  return ($stmt->fetchAll(PDO::FETCH_ASSOC));
}

function template_header($title)
{

  echo <<<EOT
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>$title</title>

    <link rel="canonical" href="home.php">

    <!-- Bootstrap core CSS -->
<link href= "css/style.css" rel="stylesheet" >
<link href ="css/product.css" rel="stylesheet">
<link href="css/brands.css" rel="stylesheet">
      <link href="css/all.css" rel="stylesheet">
      <link href="css/all.min.css" rel="stylesheet">
      <link href="css/fontawesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/c83b2f6af9.js" crossorigin="anonymous"></script>
<script src="../DBHolder/jquery.js">
////////
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    </script>
  </head>
        <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }

        .result p{
          margin: 0;
          padding: 7px 10px;
          border: 1px solid #CCCCCC;
          border-top: none;
          cursor: pointer;
        }
        .result p:hover{
          background: #f2f2f2;
        }
      }
            
    </style>
  <body>
  <form id = "labnol" action="home.php" method="post">
      <nav class="navbar navbar-expand-xl navbar-light bg-white  border-bottom shadow-lg">
  <a class="brand" href="product.htm#" ><i class="fas fa-dumpster-fire" style="font-size: 40px;"></i> </a> 
        <a class="flag navbar-brand font-weight-normal" href="home.php" style="color: dodgerblue ; font-size: 30px">MarkTech</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
  <input class="form-control input-lg" type="text" name="search" id="search" placeholder="Search product..." aria-label="Search">
  <br><div class="result"></div></br>
    <img onclick="startDictation()" src="//i.imgur.com/cHidSVu.gif" />
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="search1" id="search1"><i class="fas fa-concierge-bell"></i></button>
      <ul class="navbar-nav mr-auto">
         <li class="nav-item icon">
        <a class="btn btn-sm " href="#" ><i class="fas fa-medal"></i>Notifications</a>
      </li>
      <li class="nav-item active icon">
        <a class="btn btn-sm " href="product.htm" ><i class="fas fa-medal"></i>Account <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item icon" >
        <a class="btn btn-sm" href="form2.html" style="margin-right: 2rem"><i class="fas fa-medal"></i>Sale</a>
      </li>
    </ul>
     <a href="CartAndCheckout.php" style="padding-left: 1%; font-size: 2rem"><i class="fas fa-shopping-cart" ></i>  </a>
  </div>
</nav>
</form>

<script>
$(document).ready(function(){
    $('#search').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("search/backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents("#search").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>

<!-- HTML5 Speech Recognition API -->
<script>
  function startDictation() {

    if (window.hasOwnProperty('webkitSpeechRecognition')) {

      var recognition = new webkitSpeechRecognition();

      recognition.continuous = false;
      recognition.interimResults = false;

      recognition.lang = "en-US";
      recognition.start();

      recognition.onresult = function(e) {
        document.getElementById('search').value
                                 = e.results[0][0].transcript;
        recognition.stop();
        document.getElementById('labnol').submit();
      };

      recognition.onerror = function(e) {
        recognition.stop();
      }
    }
  }
</script>

EOT;
}

function template_footer()
{
  echo <<<EOT
  <!doctype html>
  <footer class="container py-5">
    
  <div class="row">
    <div class="col-sm-12 col-md-4">
     <a class="brand" href="product.htm#"><i class="fas fa-dumpster-fire"></i> </a> 
      <small class="d-block mb-3 text-muted">&copy; 2020-2021 </small>
    </div>
    <div class="col-sm-12 col-md-4" style="color: skyblue"  id="support">
      <h5>About</h5>
      <ul class="list-unstyled text-small">
        <li><a class="text-muted" href="product.htm#">Team</a></li>
        <li><a class="text-muted" href="product.htm#">Locations</a></li>
        <li><a class="text-muted" href="product.htm#">Privacy</a></li>
        <li><a class="text-muted" href="product.htm#">Support</a></li>
      </ul>
    </div>
      <div class="col-sm-12 col-md-4" id="support">
      <a href="www.facebook.com" class="icon"><i class=" fab fa-facebook-f"></i></a>
      <a href="www.instagram.com"class="icon"><i class="fab fa-instagram"></i></a>
      <a href="www.twitter.com"class="icon"> <i class=" fab fa-twitter"></i></a>
      <a href="www.telegram.com" class="icon"> <i class=" fab fa-telegram-plane"></i></a>
      </div>
      
  </div>
</footer>

EOT;
}
