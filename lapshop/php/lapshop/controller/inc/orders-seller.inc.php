<?php
if(isset($_POST["submit1"])){

    $orderId = $_POST["orderID"];
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    acceptOrder($conn, $orderId);

}
else if(isset($_POST["submit2"])) {
    
    $orderId = $_POST["orderID"];
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    cancelOrder($conn, $orderId);
}
else if(isset($_POST["submit3"])) {
    
    $orderId = $_POST["orderID"];
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    reverseOrder($conn, $orderId);
}
else{
    header("location: ../../index.php?fail");
    exit();
}
