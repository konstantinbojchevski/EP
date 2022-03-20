<?php
if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $status=1;
    $role=1;

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputSignupSeller($name, $surname, $email, $username, $pwd, $pwdRepeat) !== false){
        header("location: ../../addSeller.php?error=emptyinput");
        exit();
    }

    if(invalidUid($username) !== false){
        header("location: ../../addSeller.php?error=invaliduid");
        exit();
    }

    if(pwdMatch($pwd, $pwdRepeat) !== false){
        header("location: ../../addSeller.php?error=passwordsdontmatch");
        exit();
    }

    if(uidExists($conn, $username, $email) !== false){
        header("location: ../../addSeller.php?error=usernametaken");
        exit();
    }

    createSeller($conn, $name, $surname, $email, $username, $pwd, $role);

}
else{
    header("location: ../../addSeller.php");
    exit();
}
