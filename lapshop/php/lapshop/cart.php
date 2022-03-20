<?php
ob_start();
include('header.php');
?>

<?php
count($product->getData('cart')) ? include('controller/cart-template.php'): include('controller/emptyCart.php');
?>

<?php
include('footer.php');
?>