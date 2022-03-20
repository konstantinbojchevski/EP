<?php
if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $status=1;
    $role = 2;
    $street = $_POST["street"];
    $houseNo = $_POST["houseNo"];
    $post = $_POST["post"];
    $postNo = $_POST["postNo"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($name, $surname, $email, $username, $pwd, $pwdRepeat,  $street, $houseNo, $post, $postNo) !== false){
        header("location: ../../addCustomer.php?error=emptyinput");
        exit();
    }

    if(invalidUid($username) !== false){
        header("location: ../../addCustomer.php?error=invaliduid");
        exit();
    }

    if(pwdMatch($pwd, $pwdRepeat) !== false){
        header("location: ../../addCustomer.php?error=passwordsdontmatch");
        exit();
    }

    if(uidExists($conn, $username, $email) !== false){
        header("location: ../../addCustomer.php?error=usernametaken");
        exit();
    }

    createCustomer($conn, $name, $surname, $email, $username, $pwd, $status, $role, $street, $houseNo, $post, $postNo);

}
else{
    header("location: ../../addCustomer.php");
    exit();
}
