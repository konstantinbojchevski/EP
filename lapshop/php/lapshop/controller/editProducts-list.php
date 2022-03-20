<section id="list-products" class="mb-4">
    <div class="container mt-4 text-center">
        <?php foreach ($products_all as $prod) {?>
            <h5><a href="<?php printf('%s?product_id=%s', 'editProduct.php', $prod['item_id']) ?>"><?php echo $prod['item_name'] ?? "Unknown"; ?></a></h5>
        <?php }?>
    </div>
</section>