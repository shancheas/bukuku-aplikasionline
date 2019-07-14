<?php
require_once "databases/Books.php";
$id = $_GET['id'];
$data = new Books();
$book = $data->get($id);
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
<div class="page-area product-page spad">
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-1">
                <figure>
                    <img class="product-big-img" src="<?= $book->cover?>" width= "300px" height="457px" alt="">
                </figure>
            </div>
            <div class="col-md-6">
                <div class="product-content">
                    <h2><?= $book->judul?></h2>
                    <div class="pc-meta">
                        <h4 class="price">Rp. <?= number_format($book->harga)?></h4>
                        <div class="review">
                        </div>
                    </div>
                    <p><?= $book->sinopsis?></p>
                    <a href="javascript:void(0)" data-id="<?= $book->id ?>" id="book-<?= $book->id?>" class="site-btn btn-line cart-btn">ADD
                        TO CART</a>
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
    const bookId = "<?= $_GET['id']?>";
    for (var id of getCart()) {
        if (id == bookId)
            toggleButton(`#book-${id}`);
    }
    $(document).on('click', '.cart-btn', (e) => {
        toggleButton(e.target);
        const bookId = $(e.target).data('id');
        toggleCart(bookId);
        var cart = getCart();
        console.log({bookId, cart});
        $('#total-item').text(cartCount());
    });
</script>
</body>
</html>