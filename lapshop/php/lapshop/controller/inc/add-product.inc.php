<?php

if(isset($_POST["submit"])){

    $brand = $_POST["brand"];
    $name = $_POST["name"];
    $rating = $_POST["rating"];
    $price = $_POST["price"];
    $description = $_POST["desc"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputAddProduct($brand, $name, $price, $rating, $description) !== false){
        header("location: ../../addProduct.php?error=emptyinput");
        exit();
    }

    addProduct($conn, $brand, $name, $price, $rating, $description);

}
else{
    header("location: ../../addProduct.php");
    exit();
}
