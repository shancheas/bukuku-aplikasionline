<?php

$books = [
    [
        "cover" => "img/products/1.jpg",
        "judul" => "The Power of Habit",
        "harga" => 90000,
        "penulis" => "Charles Duhigg",
        "tahun" => "",
        "sinopsis" => ""
    ],
    [
        "cover" => "https://cdn.gramedia.com/uploads/items/9786020497822_Cov_Conan_95__w414_hauto.jpg",
        "judul" => "Detektif Conan 95",
        "harga" => 25000,
        "penulis" => "Aoyama Gosho",
        "tahun" => "",
        "sinopsis" => ""
    ],
    [
        "cover" => "https://cdn.gramedia.com/uploads/items/9786020628509_PEMETIK_BINTA_VvBrvij__w414_hauto.jpg",
        "judul" => "Pemetik Bintang - Edisi Bertanda Tangan",
        "harga" => 82000,
        "penulis" => "Venerdi Handoyo",
        "tahun" => "",
        "sinopsis" => ""
    ],
    [
        "cover" => "https://cdn.gramedia.com/uploads/items/9789797809348_Jika-Kita-Tak-Pernah-Jatuh-Cinta__w414_hauto.jpg",
        "judul" => "Jika Kita Tak Pernah Jatuh Cinta",
        "harga" => 88000,
        "penulis" => "Alvi Syahrin",
        "tahun" => "",
        "sinopsis" => ""
    ],
    [
        "cover" => "https://cdn.gramedia.com/uploads/items/9786020623399_Komet_Minor_c__w414_hauto.jpg",
        "judul" => "Komet Minor",
        "harga" => 105000,
        "penulis" => "Tere Liye",
        "tahun" => "",
        "sinopsis" => ""
    ],
    [
        "cover" => "https://cdn.gramedia.com/uploads/items/9786020621173_Marketing-4.0_Bergerak-dari-Tradisional-ke-Digital__w414_hauto.jpg",
        "judul" => "Marketing 4.0: Bergerak dari Tradisional ke Digital",
        "harga" => 78000,
        "penulis" => "PHILIP KOTLER, HERMAWAN KARTAJAYA, IWAN SETIAWAN",
        "tahun" => "",
        "sinopsis" => ""
    ],
    [
        "cover" => "https://cdn.gramedia.com/uploads/items/9786020209883__w414_hauto.jpg",
        "judul" => "Dooly World Culture 05 : Amerika - Negeri Paman Sam",
        "harga" => 40000,
        "penulis" => "Kim Tae Hyung",
        "tahun" => "",
        "sinopsis" => ""
    ],
    [
        "judul" => "Goodbye, Things: Hidup Minimalis ala Orang Jepang",
        "cover" => "https://cdn.gramedia.com/uploads/items/9786020398402_Goodbye-Things_Hidup-Minimalis-ala-Orang-Jepang__w414_hauto.jpg",
        "harga" => 78000,
        "penulis" => "Fumio Sasaki",
        "tahun" => "",
        "sinopsis" => ""
    ],
];

function getBook($id) {
    global $books;
    foreach ($books as $book) {
        if ($book['id'] == $id) return $book;
    }

    return [];
}