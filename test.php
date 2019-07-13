<?php
require_once "databases/Books.php";
require_once "data/books.php";

$b = new Books();
foreach ($books as $book) {
    $b->insert($book);
}

var_dump($b->getAll());