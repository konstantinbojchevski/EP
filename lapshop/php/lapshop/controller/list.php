<?php
$brand = array_map(function ($pro){ return $pro['item_brand']; }, $products);
$unique = array_unique($brand);

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['added'])){
        $Cart->addToCart($_POST['user_id'], $_POST['item_id']);
    }
}

$in_cart = $Cart->getCartId($product ->getDataCurrent('cart', $_SESSION["userid"] ?? 1));

?>
<section id="list-product" class="mb-4">
    <div class="container">
        <div class="row">
            <div class="col-1">
                <div id="filters" class="button-group text-left font-primary font-size-16">
                    <button class="btn is-checked" data-filter="*"><strong>All Products</strong></button>
                <?php
                array_map(function ($brand){
                    printf('<button class="btn" data-filter=".%s">%s</button><br>', $brand, $brand);
                }, $unique);
                ?>
            </div>
            </div>
            <div class="col-10">
                <div class="grid">
                <?php array_map(function ($item) use($in_cart){ ?>
                    <div class="grid-item <?php echo $item['item_brand'] ?? "Brand" ; ?>">
                        <div class="item py-2" style="width: 200px; padding-left: 30px; padding-right: 32px">
                            <div class="product font-primary">
                                <a href="<?php printf('%s?item_id=%s', 'product.php',  $item['item_id']); ?>"><img src="<?php echo $item['item_image'] ?? "./assets/products/13.png"; ?>" alt="product1" class="img-fluid"></a>
                                <div class="text-center" style="padding-top: 3px">
                                    <h6><?php echo $item['item_name'] ?? "Unknown"; ?></h6>
                                    <div class="rating text-warning font-size-12">
                                        <?php
                                        for( $x = 0; $x < 5; $x++ )
                                        {
                                            if( floor( $item['item_rating'])-$x >= 1 )
                                            { echo '<span><i class="fas fa-star"></i></span>'; }
                                            else
                                            { echo '<span><i class="far fa-star"></i></span>'; }
                                        }
                                        ?>
                                    </div>
                                    <div class="price py-2">
                                        <span>$<?php echo $item['item_price'] ?? 0 ?></span>
                                    </div>
                                    <form method="post">
                                        <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?? '1'; ?>">
                                        <input type="hidden" name="user_id" value="<?php
                                        if (isset($_SESSION["useruid"])) {
                                            echo $_SESSION["userid"] ?? 1;
                                        }?>">
                                        <?php
                                        if (isset($_SESSION["useruid"])) {
                                            if (in_array($item['item_id'], $in_cart ?? [])){
                                                echo '<button type="submit" disabled class="btn btn-success font-size-12">In the Cart</button>';
                                            }else{
                                                echo '<button type="submit" name="added" class="btn btn-warning font-size-12">Add to Cart</button>';
                                            }
                                        }
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }, $products) ?>
            </div>
            </div>
        </div>
    </div>
</section>