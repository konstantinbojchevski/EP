<section id="list-customers" class="mb-4">
    <div class="container mt-4 text-center">
        <?php foreach ($customers as $customer) {?>
            <h5><a href="<?php printf('%s?customer_id=%s', 'editCustomer.php', $customer['usersId']) ?>"><?php echo $customer['usersName'] ?? "Unknown"; ?></a></h5>
        <?php }?>
    </div>
</section>