<?php
require_once "functions.php";
session_start();

$promo_code = 'No Promo Code';
$discount_percent = 0.00;
$discount_amount = 0;
$pdo = pdo_connect_mysql();

if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
  $product_id = (int)$_POST['product_id'];
  $quantity   = (int)$_POST['quantity']; 
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
  }
// Check the promo code if inserted
if(isset($_POST['redeem']) && ($_POST['promo_code'])!== ''){
  // We should check if this promo is available and bring its discount percent and then delete it from data base to prevent reusing it
$promo_code = $_POST['promo_code'];
$discount_percent = 5;
}


// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
  // Loop through the post data so we can update the quantities for every product in cart
  foreach ($_POST as $k => $v) {
      if (strpos($k, 'quantity') !== false && is_numeric($v)) {
          $id = str_replace('quantity-', '', $k);
          $quantity = (int)$v;
          // Always do checks and validation
          if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
              // Update new quantity
              $_SESSION['cart'][$id] = $quantity;
          }
      }
  }
  // Prevent form resubmission...
  header('location: CartAndCheckout.php');
  exit;
}


// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
  // Remove the product from the shopping cart
  unset($_SESSION['cart'][$_GET['remove']]);
}

// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;

// If there are products in cart
if ($products_in_cart) {
  // There are products in the cart so we need to select those products from the database
  // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)

  $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));

  $stmt1 = $pdo->prepare('SELECT * FROM procomp   WHERE pro_id IN (' . $array_to_question_marks . ')');

  $stmt2 = $pdo->prepare('SELECT * FROM proclient WHERE pro_id IN (' . $array_to_question_marks . ')');
  
  // We only need the array keys, not the values, the keys are the id's of the products
  $stmt1->execute(array_keys($products_in_cart));
  $stmt2->execute(array_keys($products_in_cart));
  //$stmt->execute(['id' => $_POST['product_id']]);

  // Fetch the products from the database and return the result as an Array
  $products1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
  $products2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
  // Calculate the subtotal
  foreach ($products1 as $product) {
    if ($products_in_cart[$product['pro_id']] > $product['amount']) { $products_in_cart[$product['pro_id']] = $product['amount'];}
    $subtotal += ((float)$product['cost'] * (int)$products_in_cart[$product['pro_id']]) - (($discount_percent/100)*((float)$product['cost'] * (int)$products_in_cart[$product['pro_id']]));
    $discount_amount += (($discount_percent/100)*((float)$product['cost'] * (int)$products_in_cart[$product['pro_id']]));
  }
  foreach ($products2 as $product) {
    if ($products_in_cart[$product['pro_id']] > $product['amount']) { $products_in_cart[$product['pro_id']] = $product['amount'];}
    $subtotal += ((float)$product['cost'] * (int)$products_in_cart[$product['pro_id']]) - (($discount_percent/100)*((float)$product['cost'] * (int)$products_in_cart[$product['pro_id']]));
    $discount_amount += (($discount_percent/100)*((float)$product['cost'] * (int)$products_in_cart[$product['pro_id']]));
  }
}
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

 <?=template_header('Your cart')?>

  <div class="container" style="padding-top: 10% ;">
    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Your Cart</span>
          <span class="badge badge-secondary badge-pill"><?= $num_items_in_cart ?></span>
        </h4>
        <form action="CartAndCheckout.php" method="post">
        <ul class="list-group mb-3">
          <?php if ($num_items_in_cart != 0) foreach ($products1 as $product) : ?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0"><?=$product['pro_name']?></h6>
                <small class="text-muted"><a href="CartAndCheckout.php?remove=<?=$product['pro_id']?>">Remove</a></small>
              </div>
              <input type="number" name="quantity-<?=$product['pro_id']?>" value="<?=$products_in_cart[$product['pro_id']]?>" min="1" max="<?=$product['amount']?>" placeholder="Quantity" required>
              <span class="text-muted">&dollar;<?= ($products_in_cart[$product['pro_id']] * $product['cost']) ?></span>
            </li>
          <?php endforeach ?>
          <?php if ($num_items_in_cart != 0) foreach ($products2 as $product) : ?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0"><?=$product['pro_name']?></h6>
                <small class="text-muted"><a href="CartAndCheckout.php?remove=<?=$product['pro_id']?>">Remove</a></small>
              </div>
              <input type="number" name="quantity-<?=$product['pro_id']?>" value="<?=$products_in_cart[$product['pro_id']]?>" min="1" max="<?=$product['amount']?>" placeholder="Quantity" required>
              <span class="text-muted">&dollar;<?= ($products_in_cart[$product['pro_id']] * $product['cost']) ?></span>
            </li>
          <?php endforeach ?>
          <li class="list-group-item d-flex justify-content-between bg-light">
            <div class="text-success">
              <h6 class="my-0">Discount code</h6>
              <small><?=$promo_code?></small>
            </div>
            <span class="text-success">-$<?=$discount_amount?></span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (USD)</span>
            <strong>&dollar;<?=$subtotal?></strong>
          </li>
        </ul>
          <div class="input-group">
            <input type="text" class="form-control" name="promo_code" placeholder="Promo code">
            <div class="input-group-append">
              <button type="submit" name="redeem" class="btn btn-secondary">Redeem</button>
            </div>
          </div>
          <div class="input-group-append">
            <input type="submit" value="Update" name="update">
        </div>
        </form>
      </div>
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Billing address</h4>
        <form class="needs-validation" novalidate>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">First name</label>
              <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Last name</label>
              <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="username">Username</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">@</span>
              </div>
              <input type="text" class="form-control" id="username" placeholder="Username" required>
              <div class="invalid-feedback" style="width: 100%;">
                Your username is required.
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="email">Email <span class="text-muted">(Optional)</span></label>
            <input type="email" class="form-control" id="email" placeholder="you@example.com">
            <div class="invalid-feedback">
              Please enter a valid email address for shipping updates.
            </div>
          </div>

          <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
            <div class="invalid-feedback">
              Please enter your shipping address.
            </div>
          </div>

          <div class="mb-3">
            <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
            <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
          </div>

          <div class="row">
            <div class="col-md-5 mb-3">
              <label for="country">Country</label>
              <select class="custom-select d-block w-100" id="country" required>
                <option value="">Choose...</option>
                <option>United States</option>
              </select>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="state">State</label>
              <select class="custom-select d-block w-100" id="state" required>
                <option value="">Choose...</option>
                <option>California</option>
              </select>
              <div class="invalid-feedback">
                Please provide a valid state.
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="zip">Zip</label>
              <input type="text" class="form-control" id="zip" placeholder="" required>
              <div class="invalid-feedback">
                Zip code required.
              </div>
            </div>
          </div>
          <hr class="mb-4">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="same-address">
            <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="save-info">
            <label class="custom-control-label" for="save-info">Save this information for next time</label>
          </div>
          <hr class="mb-4">

          <h4 class="mb-3">Payment</h4>

          <div class="d-block my-3">
            <div class="custom-control custom-radio">
              <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
              <label class="custom-control-label" for="credit">Credit card</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
              <label class="custom-control-label" for="debit">Debit card</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
              <label class="custom-control-label" for="paypal">PayPal</label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="cc-name">Name on card</label>
              <input type="text" class="form-control" id="cc-name" placeholder="" required>
              <small class="text-muted">Full name as displayed on card</small>
              <div class="invalid-feedback">
                Name on card is required
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="cc-number">Credit card number</label>
              <input type="text" class="form-control" id="cc-number" placeholder="" required>
              <div class="invalid-feedback">
                Credit card number is required
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="cc-expiration">Expiration</label>
              <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
              <div class="invalid-feedback">
                Expiration date required
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="cc-cvv">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
              <div class="invalid-feedback">
                Security code required
              </div>
            </div>
          </div>
          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit">Continue </button>
        </form>
      </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <div class="row">
        <div class="col-12 col-md">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mb-2" role="img" viewBox="0 0 24 24" focusable="false">
            <title>Product</title>
            <circle cx="12" cy="12" r="10" />
            <path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94" />
          </svg>
          <small class="d-block mb-3 text-muted">&copy; 2020-2021 </small>
        </div>


        <ul class="list-inline">
          <li class="list-inline-item"><a href="checkout.htm#">Privacy</a></li>
          <li class="list-inline-item"><a href="checkout.htm#">Terms</a></li>
          <li class="list-inline-item"><a href="checkout.htm#">Support</a></li>
        </ul>
      </div>
    </footer>
  </div>
  <script src="../../../../code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="../../dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://getbootstrap.com/./examples/checkout/form-validation.js"></script>
</body>

</html>