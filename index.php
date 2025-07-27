<?php

require_once "route.php";
require_once "model/Bahan.php";
require_once "model/Keranjang.php";


get("/", function(){
    $bahan = Bahan::get();
    return include 'views/home.php';
});