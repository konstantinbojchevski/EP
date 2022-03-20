<?php
ob_start();
include('header.php');
?>

<?php
        
?>
<section id="list-sellers" class="mb-4">
    <div class="container mt-4 text-center">
        <h3>All (unresolved):</h3>
        <?php foreach($order ->getDataCurrent('orders', $_SESSION["userid"] ?? 1) as $ord) {
            if($ord['accepted'] == 0 && $ord['cancelled'] == 0) {
            $name = $order->getProduct($ord['item_name'])?>
            <div class="row" style="margin-bottom: 30px">
                <h5><a href="<?php printf('%s?item_id=%s', 'product.php',  $ord['item_name']); ?>"><?php echo $name['item_name'];?></a></h5>
            </div>
        <?php 
            }
        }
    ?> 
    </div>
    <hr>
    <div class="container mt-4 text-center">
        <h3>Accepted:</h3>
        <?php foreach($order ->getDataCurrent('orders', $_SESSION["userid"] ?? 1) as $ord) {
            if($ord['accepted'] == 1) {
            $name = $order->getProduct($ord['item_name'])?>
            <div class="row" style="margin-bottom: 30px">
                <h5><a href="<?php printf('%s?item_id=%s', 'product.php',  $ord['item_name']); ?>"><?php echo $name['item_name'];?></a></h5>
            </div>
        <?php 
            }
        }
    ?> 
    </div>
    <hr>
    <div class="container mt-4 text-center">
        <h3>Cancelled:</h3>
        <?php foreach($order ->getDataCurrent('orders', $_SESSION["userid"] ?? 1) as $ord) {
            if($ord['cancelled'] == 1) {
            $name = $order->getProduct($ord['item_name'])?>
            <div class="row" style="margin-bottom: 30px">
                <h5><a href="<?php printf('%s?item_id=%s', 'product.php',  $ord['item_name']); ?>"><?php echo $name['item_name'];?></a></h5>
            </div>
        <?php 
            }
        }
    ?> 
    </div>
      

</section>

<?php
include('footer.php');
?>