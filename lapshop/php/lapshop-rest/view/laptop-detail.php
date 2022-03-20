<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Laptop detail</title>

<h1>Details of: <?= $item_brand ?></h1>

<ul>
    <li>Brand: <b><?= $item_brand ?></b></li>
    <li>Name: <b><?= $item_name ?></b></li>
    <li>Price: <b><?= $item_price ?> EUR</b></li>
    
    <li>Description: <i><?= $item_desc ?></i></li>
</ul>
