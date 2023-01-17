<?php  
 //pagination.php  
 require "../DBHolder/DBManager.php";
require "functions.php";

 $record_per_page = 5;  
 $page = '';  
 $output = '';  
 if(isset($_POST["page"]))  
 {  
      $page = $_POST["page"];  
 }  
 else  
 {  
      $page = 1;  
 }  
 $start_from = ($page - 1)*$record_per_page; 
  $pdo = pdo_connect_mysql();
  $stmt = $pdo->prepare("SELECT * FROM procomp UNION ALL SELECT * FROM 
    proclient ORDER BY cost DESC LIMIT {$start_from},{$record_per_page}");
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

 
 $output .= '  
     <div class="row">  
 ';  
  $count = 0;
    foreach ($result as $product) {
      $output.=' <div class="col-lg-3 col-md-4 col-sm-12" style="padding-bottom:2%">
        <div class="card" data-id="'.$count .'">';
        $count++;
        $output.='<a href = "product.php?id='.$product["pro_id"].'"><img src="../DBHolder/'.$product['image'].'" class="card-img-top" alt="..."></a>
          <div class="card-body">
            <h4 class="card-title">'.$product['pro_name'].'
             </h4>
            <h1 class="card-title pricing-card-title"><small class="text-muted">&dollar;'.$product['cost'] - (($product['discount_percent'] / 100) * $product['cost']).'</small>';
            if ($product['discount_percent'] > 0){
              $output.=' <span><strike><small class="text-muted">&dollar;'.$product['cost'] .'</small></strike></span>';
            }
            $output.=' </h1>';
            $rate = (int)($product['rate']);           // The rate without the decimal part
            for ($i = 0; $i < $rate; $i++) {
              $output.=' <i class="fa fa-star"></i>';
            }
             if (is_float($product['rate'])){
              $output.=' <i class="fas fa-star-half"></i>';
             }
             $output.=' </div>
          <div class="card-footer">
            <form class="form-submit">
              <input type="hidden" name="product_id" id="product_id" value="'. $product['pro_id'] .'">
              <input type="hidden" name="quantity" id="quantity" value="1">
              <div class="buttons"> <button id="addItem" class="cart-button b"> <span class="add-to-cart">AddToCart</span> <span class="added">Done !</span>
                  <i class="fa fa-shopping-cart"></i> </button>
                  <button><img src="buttons/wishlist-icon1.jpg" /></button>
            </form>
          </div>

          
        </div>
      </div>
    
  </div>';
    }
  
   
  $pdo = pdo_connect_mysql();
  $stmt1 = $pdo->prepare("SELECT * FROM procomp UNION ALL SELECT * FROM 
    proclient ORDER BY cost DESC ");
  $stmt1->execute();
  $page_result = $stmt1->fetchAll(PDO::FETCH_ASSOC); 
 $total_records = $pdo->query('SELECT * FROM procomp UNION ALL SELECT * FROM 
    proclient')->rowCount(); 
 $total_pages = ceil($total_records/$record_per_page);
 for($i=1; $i<=$total_pages; $i++)  
 {  
      $output .= "<span class='pagination_link_pl_2' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
 }  
 $output .= '</div><br /><br />';  
 echo $output;  
 ?>  