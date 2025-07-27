<?php

require_once "route.php";
require_once "model/Bahan.php";
require_once "model/Keranjang.php";


get("/", function(){
    $bahan = Bahan::get();
    return include 'views/home.php';
});
get("/keranjang", function(){
    $keranjang = Keranjang::get();
    return include 'views/keranjang.php';
});

post("/keranjang/tambah", function(){
    $data = [
        'bahan_id' => $_POST['bahan_id'],
        'porsi' => $_POST['porsi']
    ];
    Keranjang::create($data);
    header("Location: /keranjang");
    exit();
});

