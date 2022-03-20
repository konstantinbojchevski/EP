<section id="list-sellers" class="mb-4">
    <div class="container mt-4 text-center">
        <h3>All (unresolved):</h3>
        <?php foreach ($orders_all as $orders) {
            if($orders['accepted'] == 0 && $orders['cancelled'] == 0) {
            $name = $order->getProduct($orders['item_name'])?>
        <div class="row" style="margin-bottom: 30px">
            <h5><a href="<?php printf('%s?item_id=%s', 'product.php',  $orders['item_name']); ?>"><?php echo $name['item_name'];?></a></h5>
            <div class="container text-center">
                <form action="controller/inc/orders-seller.inc.php" method="post">
                    <input type="hidden" class="form-control" name="orderID" value="<?php echo $orders['order_id'] ?? 1 ?>">
                    <button type="submit" name="submit1" class="btn btn-success font-size-12" style="width: 150px; margin-right: 3px">Accept</button>
                    <button type="submit" name="submit2" class="btn btn-danger font-size-12" style="width: 150px; margin-right: 3px">Cancel</button>
                </form>
            </div>
            
        </div>
        <?php 
        }
        }?>
        
    </div>
    <hr>
        <div class="container mt-4 text-center">
        <h3>Accepted:</h3>
        <?php foreach ($orders_all as $orders) {
            if($orders['accepted'] == 1) {
                $name = $order->getProduct($orders['item_name'])?>
                <div class="row" style="margin-bottom: 10px">
                    <h5><a href="<?php printf('%s?item_id=%s', 'product.php',  $orders['item_name']); ?>"><?php echo $name['item_name'];?></a></h5>
                </div>
                <div class="container text-center">
                    <form action="controller/inc/orders-seller.inc.php" method="post">
                        <input type="hidden" class="form-control" name="orderID" value="<?php echo $orders['order_id'] ?? 1 ?>">
                        <button type="submit" name="submit3" class="btn btn-warning font-size-12" style="width: 150px; margin-right: 3px">Reverse</button>
                    </form>
                </div>
        <?php
            }
        }?>
        </div>
    
    <hr>
        <div class="container mt-4 text-center">
        <h3>Cancelled:</h3>
        <?php foreach ($orders_all as $orders) {
            if($orders['cancelled'] == 1) {
                $name = $order->getProduct($orders['item_name'])?>
                <div class="row" style="margin-bottom: 10px">
                    <h5><a href="<?php printf('%s?item_id=%s', 'product.php',  $orders['item_name']); ?>"><?php echo $name['item_name'];?></a></h5>
                </div>
        <?php
            }
        }?>
        </div>

</section>