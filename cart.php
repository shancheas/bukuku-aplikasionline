<?php
require_once "databases/Books.php";
session_start();
$data = new Books();
$ids = $_SESSION['ids'];
$books = empty($ids) ? [] : $data->whereIn('id', $ids);
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

<div class="page-info-section page-info">
    <div class="container">
        <div class="site-breadcrumb">
            <h1>Shopping Cart</h1>
        </div>
        <img src="assets/img/page-info-art.png" alt="" class="page-info-art">
    </div>
</div>


<!-- Page -->
<div class="page-area cart-page spad">
    <div class="container">
        <div class="cart-table">
            <table>
                <thead>
                <tr>
                    <th class="product-th">Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th class="total-th">Total</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td class="product-col">
                            <img src="<?= $book->cover?>" alt="<?= $book->judul?>">
                            <div class="pc-title">
                                <h4><?= $book->judul?></h4>
                            </div>
                        </td>
                        <td class="price-col">Rp. <?= number_format($book->harga)?></td>
                        <td class="quy-col">
                            <div class="quy-input">
                                <span>Qty</span>
                                <input type="number" class="btn-qty" data-id="<?= $book->id?>" data-price="<?= $book->harga?>" value="1" min="0"/>
                            </div>
                        </td>
                        <td class="total-col" data-total="<?= $book->harga?>" id="total-book<?= $book->id?>">Rp. <?= number_format($book->harga)?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="row cart-buttons">
            <div class="col-lg-5">
                <a href="index.php" class="site-btn btn-continue">Continue shooping</a>
            </div>
            <div class="col-lg-7 text-lg-right text-left">
                <div class="site-btn btn-clear" id="clear-cart">Clear cart</div>
            </div>
        </div>
    </div>

    <div class="card-warp">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="shipping-info">
                        <h4>Shipping method</h4>
                        <p>Select the one you want</p>
                        <div class="shipping-chooes">
                            <div class="sc-item">
                                <input type="radio" name="sc" id="one" value="40000">
                                <label for="one">Next day delivery<span>Rp. 40.000</span></label>
                            </div>
                            <div class="sc-item">
                                <input type="radio" name="sc" checked="checked" id="two" value="22000">
                                <label for="two">Standard delivery<span>Rp. 22.000</span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offset-lg-2 col-lg-6">
                    <div class="cart-total-details">
                        <h4>Cart total</h4>
                        <p>Final Info</p>
                        <ul class="cart-total-card">
                            <li>Subtotal<span id="subtotal">$59.90</span></li>
                            <li>Shipping<span id="ongkir">Free</span></li>
                            <li class="total">Total<span id="total-all">$59.90</span></li>
                        </ul>
                        <a class="site-btn btn-full" href="checkout.html">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Page end -->


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
    let total = 0;
    let ongkir = 22000;
    countTotal();
    $('#clear-cart').on('click', e => {
        clearCart();
        $.post(`api/cart.php`, {ids: JSON.stringify(getCart())}, response => {
            console.log(response);
            window.location = 'cart.php';
        })
    });

    $(document).on('change', '.btn-qty', e => {
       $this = $(e.target);
       const id = $this.data('id');
       const price = $this.data('price');
       const qty = $this.val();

       $(`#total-book${id}`).text(`Rp ${numberFormat(price * qty)}`);
       $(`#total-book${id}`).data('total', price * qty);
        countTotal();
    });

    $('input[type=radio][name=sc]').change(function() {
        ongkir = this.value;
        countTotal();
    });

    function countTotal() {
        total = 0;
        for (let element of $('.total-col')) {
            total += $(element).data('total');
        }
        $('#subtotal').text(`Rp ${numberFormat(total)}`);
        $('#ongkir').text(`Rp ${numberFormat(ongkir)}`);
        console.log(total + ongkir);
        $('#total-all').text(`Rp ${numberFormat(parseInt(total) + parseInt(ongkir))}`);
    }
</script>
</body>
</html>