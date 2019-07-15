<?php
session_start();
if (is_null($_SESSION['user'])){
    header('location: login.php');
}

$customer = $_SESSION['customer'];

$cart = isset($_POST['cart']) ? json_decode($_POST['cart']) : [];
if (empty($cart)) {
    header('location: cart.php');
}
$ongkir = isset($_POST['ongkir']) ? $_POST['ongkir'] : 0;
$subtotal = array_map(function ($item) {
    return $item->price * $item->qty;
}, $cart);

$total = array_sum($subtotal) + $ongkir;
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>BUKUKU</title>
    <meta charset="UTF-8">
    <meta name="description" content="The Plaza eCommerce Template">
    <meta name="keywords" content="plaza, eCommerce, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="assets/css/owl.carousel.css"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
    <link rel="stylesheet" href="assets/css/animate.css"/>

</head>
<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<?php
require_once "components/navbar.php";
?>



<!-- Page -->
<div class="page-area cart-page spad">
    <div class="container">
        <form class="checkout-form" method="post" action="api/checkout.php">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="checkout-title">Billing Address</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" placeholder="First Name" name="firstname" value="<?= $customer->firstname?>" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Last Name" name="lastname" value="<?= $customer->lastname?>" required>
                        </div>
                        <div class="col-md-12">

                            <input type="text" placeholder="Phone no *"  name="phone" required>
                            <textarea placeholder="Address" rows="4" style="height: 200px;" name="address" ></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="order-card">
                        <div class="order-details">
                            <div class="od-warp">
                                <h4 class="checkout-title">Your order</h4>
                                <table class="order-table">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($cart as $item):?>
                                    <tr>
                                        <td><?= $item->title . ' * ' . $item->qty . ' Qty'?></td>
                                        <td>Rp. <?= number_format(($item->price * $item->qty))?></td>
                                    </tr>
                                    <?php endforeach;?>
                                    <tr>
                                        <td>SubTotal</td>
                                        <td>Rp. <?= number_format(array_sum($subtotal))?></td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <td>Shipping</td>
                                        <td>Rp. <?= $ongkir?></td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <th>Rp. <?= $total?></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="pm-item">
                                    <input type="radio" id="two">
                                    <label for="two">Cash on delievery</label>
                                </div>
                                <div class="pm-item">
                                    <input type="radio" id="four" checked>
                                    <label for="four">Direct bank transfer</label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="books" value='<?= $_POST['cart']?>'>
                        <button type="submit" class="site-btn btn-full">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Page -->



<!-- Footer section -->
<footer class="footer-section">
    <div class="container">
        <p class="copyright">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </p>
    </div>
</footer>
<!-- Footer section end -->


<!--====== Javascripts & Jquery ======-->
<?php
require_once "components/js.php";
?>
<script>
    $('.checkout-form').validate({
        rules: {
            address: {
                required: true
            },
            phone: {
                number: true
            }
        }
    });
</script>
</body>
</html>