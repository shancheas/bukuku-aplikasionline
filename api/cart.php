<?php
$ids = isset($_POST['ids']) ? json_decode($_POST['ids']) : [];

session_start();
$_SESSION['ids'] = $ids;

echo json_encode([
   'status' => $_SESSION['ids']
]);