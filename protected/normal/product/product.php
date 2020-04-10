<?php  
    if(!array_key_exists('ID', $_GET) || empty($_GET['ID'])) {
        header('Location: index.php');
    }

    $product = getProduct($_GET['ID']);

?>
<?php if ($product == false) : ?>
    <?php    require_once PRODUCT_DIR.'notfound.php'; ?>
<?php else: ?>
    <h2><?=$product['product_brand'].' '.$product['product_name']; ?></h2>
    <p class="category"><?=$product['category']; ?></p>

    <div class="product">
        <div class="row">
            <div class="col">
                
            </div>
            <div class="col">
                <form method="POST">
                    <div class="form-row justify-content-md-center">
                        <div class="form-group col-md-2">
                           <input type ="number" class="form-control" id="productQuantity" name="quantity" value="1" required>
                        </div>
                        <div class="col-md-auto">
                            <button type="submit" class="btn btn-primary" name="addCart">Add to cart</button>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <?='A raktáron: '.$product['in_stock'].' db'; ?>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3>Leírás</h3>
                <p class="description"><?=$product['description']; ?></p>
            </div>
        </div>
    </div>

<?php endif; ?>
        


    



