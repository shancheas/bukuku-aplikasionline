<?php
require_once '../databases/Users.php';
require_once '../databases/Customers.php';

$user = new Users();
$customer = new Customers();
session_start();
if (!isset($_POST['email']) || !isset($_POST['password'])) {
    $_SESSION['message'] = 'email atau password tidak boleh kosong';
    header('location: ../register.php');
    return;
}

$users = $user->where(['email' => $_POST['email']]);
if (!is_null($users)) {
    $_SESSION['message'] = 'email sudah terdaftar';
    header('location: ../register.php');
    return;
}

unset($_SESSION['message']);

$user_login = [
    'email' => $_POST['email'],
    'password' => md5($_POST['password'])
];
$user->insert($user_login);
$auth = $user->where($user_login);

$user_data = [
    'firstname' => $_POST['firstname'],
    'lastname' => $_POST['lastname'],
    'email' => $auth->email,
    'user_id' => $auth->id
];

$customer->insert($user_data);
$customer_data = $customer->where($user_data);

$_SESSION['customer'] = $customer_data;
$_SESSION['user'] = $user_data;

header('location: ../index.php');