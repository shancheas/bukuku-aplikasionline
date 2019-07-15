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
                <tr>
                    <td>Nomor resi :</td>
                    <td>Tanggal Order : </td>
                </tr>
            </table>
            <br>
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
                                <h4 id="title-book<?= $book->id?>"><?= $book->judul?></h4>
                            </div>
                        </td>
                        <td class="price-col">Rp. <?= number_format($book->harga)?></td>
                        <td class="quy-col"></td>
                        <td class="total-col" data-total="<?= $book->harga?>" id="total-book<?= $book->id?>">Rp. <?= number_format($book->harga)?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
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
    let items = [];
    countTotal();
    $('#clear-cart').on('click', e => {
        clearCart();
        $.post(`api/cart.php`, {ids: JSON.stringify(getCart())}, response => {
            window.location = 'cart.php';
        })
    });

    $('.btn-qty').on('change', e => {
       $this = $(e.target);
       const id = $this.data('id');
       const price = $this.data('price');
       const qty = $this.val();

       items[id] = {
           'id': id,
           'price': price,
           'qty': qty,
           'title': $(`#title-book${id}`).text()
       };

       $(`#total-book${id}`).text(`Rp ${numberFormat(price * qty)}`);
       $(`#total-book${id}`).data('total', price * qty);
       countTotal();
    });

    $('input[type=radio][name=sc]').change(function() {
        ongkir = this.value;
        countTotal();
    });

    $('#btn-checkout').click(e => {
        e.preventDefault();
        let cart = [];
        items.forEach(item => {
            cart.push({
                ...item
            });
        });
        $('input[name=cart]').val(JSON.stringify(cart));
        $('input[name=ongkir]').val(ongkir);
        $('#cart-form').submit();
    });

    function countTotal() {
        total = 0;
        for (let element of $('.total-col')) {
            total += $(element).data('total');
        }
        $('#subtotal').text(`Rp ${numberFormat(total)}`);
        $('#ongkir').text(`Rp ${numberFormat(ongkir)}`);
        $('#total-all').text(`Rp ${numberFormat(parseInt(total) + parseInt(ongkir))}`);
    }
    $('.btn-qty').change();
</script>
</body>
</html>