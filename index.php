<?php

require_once "route.php";
require_once "model/Bahan.php";

require_once "model/Keranjang.php";
require_once "controller/KeranjangController.php";
$keranjangController = new KeranjangController();

get("/", function(){
    $bahan = Bahan::get();
    return include 'views/home.php';
});

get("/keranjang", [$keranjangController, 'index']);
post("/keranjang/tambah", [$keranjangController, 'tambah']);
post("/keranjang/bayar", [$keranjangController, 'bayar']);
post('/keranjang/update/$id', [$keranjangController, 'updatePorsi']);