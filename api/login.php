<?php
require_once '../databases/Users.php';
require_once '../databases/Customers.php';

$user = new Users();
$customer = new Customers();

$result = $user->where([
    'email' => $_POST['email'],
    'password' => md5($_POST['password'])
]);

$r = $customer->where([
    'user_id' => $result->id
]);

session_start();
if (is_null($result)) {
    $_SESSION['message'] = 'email atau password salah';
    header('location: ../login.php');
    return;
}

$_SESSION['user'] = $result;
$_SESSION['customer'] = $r;
header('location: ../index.php');