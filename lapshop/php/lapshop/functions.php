<?php
require ('model/DBController.php');
require ('model/Product.php');
require ('model/Cart.php');
require ('model/User.php');
require ('model/Order.php');
$db = new DBController();
$product = new Product($db);
$products_all = $product->getData();
$products = $product->getActiveProducts();
$customer=new User($db);
$customers=$customer->getCustomers();
$Cart = new Cart($db);
$seller = new User($db);
$sellers = $seller->getSellers();
$order = new Order($db);
$orders_all = $order->getData();