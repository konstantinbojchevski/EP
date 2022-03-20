<?php
    $item_id = $_GET['item_id'] ?? 1;
    $user_id = $_SESSION['userid'] ?? 1;

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['added'])){
            $Cart -> addToCart($_POST['user_id'], $_POST['item_id']);
        }
    }
    $in_cart = $Cart->getCartId($product ->getDataCurrent('cart', $_SESSION["userid"] ?? 1));
    
    foreach($product->getData() as $item):
        if($item['item_id']  == $item_id):

?>

<section id="product" class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <img src="<?php echo $item['item_image'] ?? ".assets/products/1.png"?>" alt="product" class="img-fluid">
                
            </div>
            <div class="col-sm-6 py-5">
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
                <hr>
                <table class="my-3">
                    <tr class="font-primary font-size-14">
                        <td>Price:&nbsp;</td>
                        <td class="font-size-30 text-success"><span><?php echo $item['item_price'] ?? 0?></span> <i class="fas fa-euro-sign"></i></td>
                    </tr>
                </table>
                <div>
                    <h6>Product Description:</h6>
                    <hr>
                    <p class="font-size-14 font-primary"><?php echo $item['item_desc'] ?? "Unknown"?></p>
                </div>
                <div class="form-row pt-3 font-size-16 font-primary" style="align-items: bottom">
                    <div class="col">
                        <form method="post">
                            <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?? 1; ?>">
                            <input type="hidden" name="user_id" value="<?php
                            if (isset($_SESSION["useruid"])) {
                                echo $_SESSION["userid"] ?? 1;
                            }?>">
                            <?php
                            if (isset($_SESSION["useruid"])) {
                                if(in_array($item['item_id'], $in_cart ?? [])){
                                    echo '<button type="submit" disabled class="btn btn-success font-size-16 form-control">In The Cart</button>';
                                }else{
                                    echo '<button type="submit" name="added" class="btn btn-warning font-size-16 form-control">Add to Cart</button>';
                                }
                            }
                            ?>
                        </form>
                    </div>
                    <div class="col">
                        <?php
                            if (isset($_SESSION["useruid"])) {
                                echo '<button type="submit" class="btn btn-warning form-control">Buy</button>';
                            }
                        ?>
                        
                    </div>
            </div>
            </div>
         
            
            
        </div>
    </div>
</section>

<?php
        endif;
    endforeach;
?>