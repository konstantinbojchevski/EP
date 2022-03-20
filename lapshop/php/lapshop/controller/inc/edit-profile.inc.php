<?php
if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $userId = $_POST["userID"];
    $street=$_POST["street"];
    $houseNo=$_POST["houseNo"];
    $post=$_POST["post"];
    $postNo=$_POST["postNo"];


    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputEditProfile($name, $surname, $email, $username, $pwd, $pwdRepeat, $street, $houseNo, $post, $postNo) !== false){
        header("location: ../../editProfile.php?error=emptyinput");
        exit();
    }

    if(invalidUid($username) !== false){
        header("location: ../../editProfile.php?error=invaliduid");
        exit();
    }

    if((!isset($_POST["pwdrepeat"]) && isset($_POST["pwd"])) || (isset($_POST["pwdrepeat"]) && !isset($_POST["pwd"])) || pwdMatch($pwd, $pwdRepeat) !== false){
        header("location: ../../editProfile.php?error=passwordsdontmatch");
        exit();
    }

    updateCustomer($conn, $name, $surname, $email, $username, $pwd, $street, $houseNo, $post, $postNo, $userId);

}
else{
    header("location: ../../editProfile.php");
    exit();
}
