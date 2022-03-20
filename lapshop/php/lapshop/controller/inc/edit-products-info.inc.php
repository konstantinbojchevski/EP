<?php
if(isset($_POST["submit"])){

    $brand=$_POST["brand"];
    $name = $_POST["name"];
    $rating=$_POST["rating"];
    $price=$_POST["price"];
    $description=$_POST["desc"];
    $itemid=$_POST["itemid"];


    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    updateProduct($conn, $brand, $name, $price, $rating, $description, $itemid);

}

if(isset($_POST["deactivate"])){

    $item_id = $_POST["itemid"];


    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';


    deactivateProduct($conn, $item_id);

}

if(isset($_POST["activate"])){

    $item_id = $_POST["itemid"];


    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';


    activateProduct($conn, $item_id);

}

else{
    header("location: ../../editProducts.php");
    exit();
}
