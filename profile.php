<?php
session_start();
if (is_null($_SESSION['user'])){
    header('location: login.php');
}

var_dump($_SESSION['user']);

?>

<html>
<body>
<a href="api/logout.php">keluar</a>
</body>
</html>
