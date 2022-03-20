<?php

function emptyInputSignup($name, $surname, $email, $username, $pwd, $pwdRepeat,  $street, $houseNo, $post, $postNo){
    if(empty($name) || empty($surname) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat) || empty($street)|| empty($houseNo)|| empty($post)|| empty($postNo)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function emptyInputSignupSeller($name, $surname, $email, $username, $pwd, $pwdRepeat){
    if(empty($name) || empty($surname) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}


function emptyInputAddProduct($brand, $name, $price, $rating, $description){
    if(empty($brand) || empty($name) || empty($price) || empty($rating) || empty($description)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function emptyInputLogin($username, $pwd){
    if(empty($username) || empty($pwd)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function emptyInputEditProfile($name, $surname, $email, $username, $pwd, $pwdRepeat, $street, $houseNo, $post, $postNo){
    if(empty($name) && empty($surname) && empty($email) && empty($username) && empty($pwd) && empty($pwdRepeat) && empty($street) && empty($houseNo) && empty($post) && empty($postNo)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
function emptyInputEditProfileAS($name, $surname, $email, $username, $pwd, $pwdRepeat){
    if(empty($name) && empty($surname) && empty($email) && empty($username) && empty($pwd) && empty($pwdRepeat)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUid($username){
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat){
    if($pwd !== $pwdRepeat){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function uidExists($conn, $username, $email){
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../signup.php?error=stmtfailed");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }
        else {
            $result = false;
        }
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $surname, $email, $username, $pwd, $rolechecked, $street, $houseNo, $post, $postNo){
    $sql = "INSERT INTO users (usersName, usersSurname, usersEmail, usersUid, usersPwd, userRole, street, houseNo, post, postNo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../signup.php?error=stmtfailed");
        exit();
    }
    else{
        $hashedPWD = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssssssisi", $name, $surname, $email, $username, $hashedPWD, $rolechecked, $street, $houseNo, $post, $postNo);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../signup.php?error=none");
    }
}
function updateUser($conn, $name, $surname, $email, $username, $pwd, $currentId){

    $sql = "UPDATE users SET usersName=?, usersSurname=?, usersEmail=?, usersUid=?, usersPwd=? WHERE usersId='$currentId'";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../editSeller.php?error=stmtfailed");
        exit();
    }
    else{
        $hashedPWD = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssss", $name, $surname, $email, $username, $hashedPWD);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../editSeller.php?error=none");
    }
}

function updateCustomer($conn, $name, $surname, $email, $username, $pwd, $street, $houseNo, $post, $postNo, $currentId){ //sekoj user sam si go editira profilot

    $sql = "UPDATE users SET usersName=?, usersSurname=?, usersEmail=?, usersUid=?, usersPwd=? , street=?, houseNo=?, post=?, postNo=? WHERE usersId='$currentId'";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../editProfile.php?error=stmtfailed");
        exit();
    }
    else{
        $hashedPWD = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sssssisi", $name, $surname, $email, $username, $hashedPWD, $street, $houseNo, $post, $postNo);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: logout.inc.php");
    }
}
function updateCustomerAS($conn, $name, $surname, $email, $username, $pwd, $currentId){ //koga admin ili seller si go editira profilot

    $sql = "UPDATE users SET usersName=?, usersSurname=?, usersEmail=?, usersUid=?, usersPwd=? WHERE usersId='$currentId'";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../editProfile.php?error=stmtfailed");
        exit();
    }
    else{
        $hashedPWD = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssss", $name, $surname, $email, $username, $hashedPWD);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: logout.inc.php");
    }
}
function updateCus($conn, $name, $surname, $email, $username, $pwd, $street, $houseNo, $post, $postNo, $currentID) {

    $sql = "UPDATE users SET usersName=?, usersSurname=?, usersEmail=?, usersUid=?, usersPwd=?, street=?, houseNo=?, post=?, postNo=? WHERE usersId='$currentId'";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../editCustomersList.php?error=stmtfailed");
        exit();
    }
    else{
        $hashedPWD = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssss", $name, $surname, $email, $username, $hashedPWD, $street, $houseNo, $post, $postNo);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../editCustomersList.php");
    }
}

function deactivateUser($conn, $currentId){

    $sql = "UPDATE users SET userStatus='0' WHERE usersId='$currentId'";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../editSellersList.php?error=stmtfailed");
        exit();
    }
    else{
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../editSellersList.php");
    }
}

function deactivateCustomer($conn, $currentId){

    $sql = "UPDATE users SET userStatus='0' WHERE usersId='$currentId'";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../editCustomersList.php?error=stmtfailed");
        exit();
    }
    else{
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../editCustomersList.php");
    }
}

function activateCustomer($conn, $currentId){

    $sql = "UPDATE users SET userStatus='1' WHERE usersId='$currentId'";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../editCustomersList.php?error=stmtfailed");
        exit();
    }
    else{
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../editCustomersList.php");
    }
}

function activateUser($conn, $currentId){

    $sql = "UPDATE users SET userStatus='1' WHERE usersId='$currentId'";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../editSellersList.php?error=stmtfailed");
        exit();
    }
    else{
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../editSellersList.php");
    }
}

function deactivateProduct($conn, $currentId){

    $sql = "UPDATE product SET item_status='0' WHERE item_id='$currentId'";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../editProductList.php?error=stmtfailed");
        exit();
    }
    else{
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../editProductList.php");
    }
}
function activateProduct($conn, $currentId){

    $sql = "UPDATE product SET item_status='1' WHERE item_id='$currentId'";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../editProductList.php?error=stmtfailed");
        exit();
    }
    else{
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../editProductList.php");
    }
}

function createSeller($conn, $name, $surname, $email, $username, $pwd, $role){
    $sql = "INSERT INTO users (usersName, usersSurname, usersEmail, usersUid, usersPwd, userRole) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../addSeller.php?error=stmtfailed");
        exit();
    }
    else{
        $hashedPWD = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sssss", $name, $surname, $email, $username, $hashedPWD, $role);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../addSeller.php?error=none");
    }
}
function createCustomer($conn, $name, $surname, $email, $username, $pwd, $userStatus, $userRole, $street, $houseNo, $post, $postNo){
    $sql = "INSERT INTO users (usersName, usersSurname, usersEmail, usersUid, usersPwd, userStatus, userRole, street, houseNo, post, postNo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../addCustomer.php?error=stmtfailed");
        exit();
    }
    else{
        $hashedPWD = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sssss", $name, $surname, $email, $username, $hashedPWD, $userStatus, $userRole, $street, $houseNo, $post, $postNo);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../addCustomer.php?error=none");
    }
}

function removeFromCart($conn, $id){
    $sql = "DELETE FROM cart WHERE  user_id='$id';";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../index.php?error=stmtfailed");
        exit();
    }
    else{

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../index.php");
    }
}

function acceptOrder($conn, $id) {
    $sql="UPDATE orders SET accepted = '1' WHERE order_id = '$id'";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../orders.php?error=stmtfailed");
        exit();
    }
    else{
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../orders.php");
    }
}

function reverseOrder($conn, $id) {
    $sql="UPDATE orders SET accepted = '0' WHERE order_id = '$id'";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../orders.php?error=stmtfailed");
        exit();
    }
    else{
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../orders.php");
    }
}

function cancelOrder($conn, $id) {
    $sql="UPDATE orders SET cancelled = '1' WHERE order_id = '$id'";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../orders.php?error=stmtfailed");
        exit();
    }
    else{
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../orders.php");
    }
}

function bFromCart($conn, $id){
    $sql = "INSERT INTO orders (item_name, user_id) SELECT item_id, user_id FROM cart WHERE user_id='$id';";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../index.php?error=stmtfailed");
        exit();
    }
    else{

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../index.php");
    }
}


function addProduct($conn, $brand, $name, $price, $rating, $description){
    $sql = "INSERT INTO product (item_brand, item_name, item_price, item_rating, item_desc) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../addProduct.php?error=stmtfailed");
        exit();
    }
    else{

        mysqli_stmt_bind_param($stmt, "ssdds", $brand, $name, $price, $rating, $description);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../addProduct.php?error=none");
    }
}

function updateProduct($conn, $brand, $name, $price, $rating, $description, $itemid){
    $sql = "UPDATE product SET item_brand=?, item_name=?, item_price=?, item_rating=?, item_desc=? WHERE item_id='$itemid';";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../../editProducts.php?error=stmtfailed");
        exit();
    }
    else{

        mysqli_stmt_bind_param($stmt, "ssdds", $brand, $name, $price, $rating, $description);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../../editProducts.php?error=none");
    }
}

function loginUser($conn, $username, $pwd){
    $uidExists = uidExists($conn, $username, $username);
    if($uidExists == false){
        header("location: ../../login.php?error=wronglogin");
        exit();
    }

    if($uidExists['userStatus'] == 0){
        header("location: ../../login.php?error=deactivatedaccount");
        exit();
    }


    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd,$pwdHashed);

    if ($checkPwd == false){
        header("location: ../../login.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd == true){
        
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        $_SESSION["username"] = $uidExists["usersName"];
        $_SESSION["userSurname"] = $uidExists["usersSurname"];
        $_SESSION["useremail"] = $uidExists["usersEmail"];
        $_SESSION["userrole"] = $uidExists["userRole"];
        $_SESSION["street"]=$uidExists["street"];
        $_SESSION["houseNo"]=$uidExists["houseNo"];
        $_SESSION["post"]=$uidExists["post"];
        $_SESSION["postNo"]=$uidExists["postNo"];
        
        header("location: ../../index.php");
                    
        exit();
    }
}