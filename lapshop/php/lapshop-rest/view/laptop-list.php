<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Lapshop</title>

<h1>All laptops</h1>

<ul>

    <?php foreach ($laptops as $laptop): ?>
        <li><a href="<?= BASE_URL . "laptops/" . $laptop["item_id"] ?>"><?= $laptop["item_brand"] ?>: 
        	<?= $laptop["item_name"] ?> (<?= $laptop["item_desc"] ?>)</a></li>
    <?php endforeach; ?>

</ul>
