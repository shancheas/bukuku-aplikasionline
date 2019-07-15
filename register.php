<?php
session_start();
if (isset($_SESSION['user']))
    header('location: profile.php');
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

<!-- Page -->
<div class="page-area contact-page">
    <div class="container spad">
        <div class="row">
            <div class="offset-4 col-md-4 card-warp p-4" style="background: #fff">
                <div class="cart-total-details">
                    <div class="text-center">
                        <h4 class="contact-title">REGISTER</h4>
                    </div>
                    <form class="contact-form" method="post" action="api/register.php">
                        <input type="text" placeholder="First Name" name="firstname">
                        <input type="text" placeholder="Last name" name="lastname">
                        <input type="email" placeholder="Email" name="email">
                        <input type="password" placeholder="Password" name="password">
                        <?php
//                            session_start();
                            if (isset($_SESSION['message'])) {
                                echo '<span style="color: red">'. $_SESSION['message'] .'</span>';
                                unset($_SESSION['message']);
                            }
                        ?>
                        <input type="submit" class="site-btn btn-full" value="Register" />
                    </form>
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
            Copyright &copy;<script>document.write(new Date().getFullYear());</script>
            All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
                    href="https://colorlib.com" target="_blank">Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </p>
    </div>
</footer>
<!-- Footer section end -->


<?php
require_once "components/js.php";
?>

<script>
    $('.contact-form').validate({
        rules: {
            firstname: {
                required: true,
                minlength: 3
            },
            lastname: {
                required: true,
                minlength: 1
            },
            email: {
                required: true,
                email: true,
                minlength: 10
            },
            password: {
                required: true,
                minlength: 6
            }
        }
    });
</script>


</body>
</html>