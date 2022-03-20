<section id="list-sellers" class="mb-4">
    <div class="container mt-4 text-center">
        <?php foreach ($sellers as $seller) {?>
            <h5><a href="<?php printf('%s?seller_id=%s', 'editSeller.php', $seller['usersId']) ?>"><?php echo $seller['usersName'] ?? "Unknown"; ?></a></h5>
        <?php }?>
    </div>
</section>