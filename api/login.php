<?php
require_once '../databases/Users.php';

$user = new Users();

$result = $user->where([
    'email' => $_POST['email'],
    'password' => md5($_POST['password'])
]);

session_start();
if (is_null($result)) {
    $_SESSION['message'] = 'email atau password salah';
    header('location: ../login.php');
    return;
}

$_SESSION['user'] = $result;
header('location: ../index.php');