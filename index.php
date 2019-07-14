<?php
require_once "databases/Books.php";
$data = new Books();
$books = $data->getAll();
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>BUKUKU</title>
    <meta charset="UTF-8">

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

<!-- Hero section -->
<section class="hero-section set-bg" data-setbg="assets/img/bg.jpg">
    <div class="hero-slider owl-carousel">
        <div class="hs-item">
            <div class="hs-left"><img src="assets/img/slider-img.png" width="1500px" height="500px" alt=""></div>
            <div class="hs-right">
                <div class="hs-content">
                    <div class="price">Start From 50K</div>
                    <h2><span>SALE</span> <br>BEST SELLER NOVEL</h2>
                    <!--                    <a href="" class="site-btn">Shop NOW!</a>-->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero section end -->


<!-- Product section -->
<section class="product-section spad">
    <div class="container">
        <ul class="product-filter controls">
            <li class="control" data-filter=".new">New arrivals</li>
            <li class="control" data-filter="all">Recommended</li>
            <li class="control" data-filter=".best">Best sellers</li>
        </ul>
        <div class="row" id="product-filter">

            <?php foreach ($books as $book): ?>
                <div class="mix col-lg-3 col-md-6">
                    <div class="product-item">
                        <a href="product.php?id=<?= $book->id ?>">
                            <figure>
                                <img src="<?= $book->cover ?>" alt="<?= $book->judul ?>">
                                <!--                            <div class="bache sale">SALE</div>-->
                            </figure>
                        </a>
                        <div class="product-info">
                            <h6><?= $book->judul ?></h6>
                            <p>Rp. <?= number_format($book->harga) ?></p>
                            <a href="javascript:void(0)" data-id="<?= $book->id ?>" id="book-<?= $book->id?>" class="site-btn btn-line cart-btn">ADD
                                TO CART</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- Product section end -->

<!-- Footer section -->
<footer class="footer-section">
    <div class="container">
        <p class="copyright">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script>
            All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
                    href="https://colorlib.com" target="_blank">Colorlib</a>
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
    for (var id of getCart()) {
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