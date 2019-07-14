<?php
$ids = isset($_POST['ids']) ? json_decode($_POST['ids']) : [];

var_dump($ids);
session_start();
$_SESSION['ids'] = $ids;

echo json_encode([
   'status' => $_SESSION['ids']
]);