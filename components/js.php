<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/mixitup.min.js"></script>
<script src="assets/js/sly.min.js"></script>
<script src="assets/js/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="assets/js/main.js"></script>

<script>
    function addToCart(id) {
        const cart = getCart();
        cart.push(id);

        saveCart(cart);
    }

    function removeCart(id) {
        const cart = getCart();
        const index = cart.indexOf(id);

        cart.splice(index, 1);
        saveCart(cart);
    }

    function toggleCart(id) {
        if (hasBooks(id)) {
            removeCart(id);
        } else {
            addToCart(id);
        }
    }

    function saveCart(cart) {
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    function getCart() {
        const cart = localStorage.getItem('cart') || '[]';
        return JSON.parse(cart);
    }

    function hasBooks(id) {
        const cart = getCart();
        return cart.includes(id);
    }

    function cartCount() {
        const cart = getCart();
        return cart.length;
    }

    function clearCart() {
        saveCart([]);
    }
</script>

<script>
    $('#total-item').text(cartCount());
    $('#main-cart').on('click', e => {
        $.post(`api/cart.php`, {ids: JSON.stringify(getCart())}, response => {
            console.log(response);
            window.location = 'cart.php';
        })
    });

    function numberFormat(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function toggleButton(element) {
        $(element).toggleClass("btn-fill");
        $(element).toggleClass("btn-line");

        const btnText = $(element).attr('class').includes('btn-fill') ? 'Remove From Cart' : 'add to cart';
        $(element).text(btnText.toUpperCase());

    }
</script>