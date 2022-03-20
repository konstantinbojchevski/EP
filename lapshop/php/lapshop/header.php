<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Lapshop</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="html/assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="styles/styles.css" rel="stylesheet" />
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

        <script src='https://www.google.com/recaptcha/api.js'></script>

        <?php
            require ('functions.php');
        ?>

    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="./index.php">LAPSHOP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <?php
                        if (isset($_SESSION["useruid"])){
                                if($_SESSION["userrole"] == 0) {
                                    echo "<li class=\"nav-item active\"><a class=\"nav-link\" href='addSeller.php'>Add Seller</a></li>";
                                    echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"editSellersList.php\">Edit Sellers</a></li>";
                                }
                                else if($_SESSION["userrole"] == 1) {
                                    echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"addProduct.php\">Add Product</a></li>";
                                    echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"editProducts.php\">Edit Products</a></li>";
                                    echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"orders.php\">Orders</a></li>";
                                    echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"addCustomer.php\">Add Customer</a></li>";
                                    echo "<li class=\"nav-item active\"><a class=\"nav-link\" href=\"editCustomersList.php\">Edit Customers</a></li>";
                                }
                                else {
                                    echo "<li class=\"nav-item\"><a class=\"nav-link active\" aria-current=\"page\" href=\"./index.php\">Home</a></li>";
                                    echo "<li class=\"nav-item\"><a class=\"nav-link active\" href=\"./list.php\">Browse</a></li>";
                                    echo "<li class=\"nav-item\"><a class=\"nav-link active\" href=\"./about.php\">About</a></li>";
                                    echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"./customer-orders.php\">My orders</a></li>";

                                } 
                        }
                        else {
                            echo "<li class=\"nav-item\"><a class=\"nav-link active\" aria-current=\"page\" href=\"./index.php\">Home</a></li>";
                            echo "<li class=\"nav-item\"><a class=\"nav-link active\" href=\"./list.php\">Browse</a></li>";
                            echo "<li class=\"nav-item\"><a class=\"nav-link active\" href=\"./about.php\">About</a></li>";
                        }
                        ?>
                    </ul>
                    <form class="d-flex">
                        <?php
                            if (isset($_SESSION["useruid"])){
                                if($_SESSION["userrole"] == 2) {
                                    echo "<a  href=\"cart.php\" class=\"button btn btn-outline-dark\" type=\"submit\">
                                        <i class=\"bi-cart-fill me-1\"></i>Cart<span class=\"badge bg-dark text-white ms-1 rounded-pill\">";
                                        echo count($product ->getDataCurrent('cart', $_SESSION["userid"] ?? 1));
                                        echo "</span></a>";
                                }
                            }
                        ?>
                        
                        <?php
                            if (isset($_SESSION["useruid"])){
                                if($_SESSION["userrole"] == 0) {
                                    echo "<a href=\"editProfileAdmin.php\" class=\"button btn btn-outline-dark\" style=\"margin-left: 5px; margin-right: 5px\">Edit profile</a>";
                                    echo "<a href=\"controller/inc/logout.inc.php\" class=\"button btn btn-outline-dark\">Log Out</a>";
                                }
                                else if($_SESSION["userrole"] == 1) {
                                    echo "<a href=\"editProfileAdmin.php\" class=\"button btn btn-outline-dark\" style=\"margin-left: 5px; margin-right: 5px\">Edit profile</a>";
                                    echo "<a href=\"controller/inc/logout.inc.php\" class=\"button btn btn-outline-dark\">Log Out</a>"; 
                                }
                                else {
                                    echo "<a href=\"editProfile.php\" class=\"button btn btn-outline-dark\" style=\"margin-left: 5px; margin-right: 5px\">Edit profile</a>";
                                    echo "<a href=\"controller/inc/logout.inc.php\" class=\"button btn btn-outline-dark\">Log Out</a>"; 
                                }
                            }
                            else{
                                echo "<a href=\"login.php\" class=\"button btn btn-outline-dark\" style=\"margin-right: 5px\">Log in</a>";
                                echo "<a href=\"register.php\" class=\"button btn btn-outline-dark\">Register</a>";
                            }
                        ?>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Buy your favourite laptop today!</p>
                </div>
            </div>
        </header>
        <main id="main-site">
    
