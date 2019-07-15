<?php
require_once '../databases/Details.php';
require_once '../databases/Transaction.php';

session_start();
$customer = $_SESSION['customer'];
$transaction_id = generateRandomString();
$transaction_data = [
    'nomor_transaksi' => $transaction_id,
    'pembeli_id'=> $customer->id,
    'address' => $_POST['address'],
    'status' => 'On Proses'
];
$transaction = new Transaction();
$detail = new Details();
$r = $transaction->insert($transaction_data);
$result = $transaction->where(['nomor_transaksi' => $transaction_id]);
$books = json_decode($_POST['books']);
var_dump($books);
foreach ($books as $book) {
    $details = [
        'buku_id' => $book->id,
        'transaksi_id' => $result->id,
        'qty' => $book->qty
    ];

    $detail->insert($details);
}

header('location: ../detail.php?id=' . $transaction_id);

function generateRandomString($length = 7) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}