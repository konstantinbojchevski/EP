<section id="cart" class="py-3">
    <div class="container-fluid w-75">
        <h5 class="font-primary font-size-20">Shopping cart</h5>
        <div class="row">
            <div class="col-sm-9">
                <?php
                    foreach($product ->getDataCurrent('cart', $_SESSION["userid"] ?? 1) as $item):
                        $cart = $product->getProduct($item['item_id']);
                        $subTotal[] = array_map(function ($item){
                ?>
                <div class="row border-top py-3 mt-3">
                    <div class="col-sm-3">
                        <a href="<?php printf('%s?item_id=%s', 'product.php',  $item['item_id']); ?>"><img src="<?php echo $item['item_image'] ?? "./assets/products/1.png" ?>" alt="cart1" class="img-fluid" style="height: 120px"></a>
                    </div>
                    <div class="col-sm-7">
                        <h3><?php echo $item['item_brand'] ?? "Brand"?></h3>
                        <h5 class="font-primary font-size-20"><?php echo $item['item_name'] ?? "Unknown"?></h5>
                        <div class="d-flex">
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
                        </div>
                        <div class="qty d-flex pt-2">
                            <div class="d-flex font-primary w-25">
                                <button class="qty-down border bg-light" data-id="<?php echo $item['item_id'] ?? 0; ?>"><i class="fas fa-angle-down"></i></button>
                                <input type="text" class="qty-input border px-2 w-100 bg-light" disabled value="1" placeholder="1" data-id="<?php echo $item['item_id'] ?? 0; ?>">
                                <button class="qty-up border bg-light" data-id="<?php echo $item['item_id'] ?? 0; ?>"><i class="fas fa-angle-up"></i></button>
                            </div>
                            <form method="post">
                                <input type="hidden" value="<?php echo $item['item_id'] ?? 0; ?>" name="item_id">
                                <button type="submit" name="delete-cart-submit" class="btn font-primary text-danger px-3">Delete</button>
                            </form> 
                        </div>
                    </div>
                    <div class="col-sm-2 text-right ">
                        <div class="font-size-20 text-success font-primary">
                            <span class="product_price" data-id="<?php echo $item['item_id'] ?? 0; ?>"><?php echo $item['item_price'] ?? 0?></span> <i class="fas fa-euro-sign"></i>
                        </div>
                    </div>
                </div>
                <?php
                            return $item['item_price'];
                        },$cart);
                    endforeach;
                ?>
            </div>
            <div class="col-sm-3">
                <div class="sub-total border text-center mt-2">
                    <div class="border-top py-4">
                        <h5 class="font-primary font-size-20">Total <?php echo isset($subTotal) ? count($subTotal): 0; ?> item(s): &nbsp;<span class="text-success"><span class="text-success" id="deal-price"><?php echo isset($subTotal) ? $Cart->getSum($subTotal): 0 ?></span> <i class="fas fa-euro-sign"></i></span></h5>
                        <form action="controller/inc/orders.inc.php" method="post">
                            <input type="hidden" class="form-control" name="userID" value="<?php echo $_SESSION['userid'] ?? 1 ?>">
                            <button type="submit" name="submit" class="btn btn-warning mt-3">Proceed to buy</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>