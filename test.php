<?php
require_once "databases/Books.php";
require_once "data/books.php";

$b = new Books();
//foreach ($books as $book) {
//    $b->insert($book);
//}

session_start();
var_dump($_SESSION);
var_dump($b->whereIn('id', $_SESSION['ids']));
//var_dump($b->getAll());