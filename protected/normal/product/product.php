<?php  
    if(!array_key_exists('ID', $_GET) || empty($_GET['ID'])) {
        header('Location: index.php');
    }

    $product = getProduct($_GET['ID']);

?>
<?php 
    if(array_key_exists('d', $_GET) && !empty($_GET['d']) && $_SESSION['permission'] >= 1) {
        if (!deleteProduct($_GET['d'])) {
            echo '<p id = "alert>Hiba a törlés során</p>';
        }
    }
    
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['toCart'])) {
        if(isUserLoggedIn()) {
                $postData = [
                'quantity' => $_POST['quantity'],
                'product_id' => $_POST['product_id']
            ];

            if($postData['quantity'] < 1) {
                echo "<p id='alert'>Mennyiség nem megfelelő</p>";
            }
            else if(!tocart($postData['product_id'], $postData['quantity'])) {
                echo "<p id='alert'>Nincs elegendő a raktáron</p>";
            }
            else {
                echo "<p id=info>Hozzáadva a kosárhoz</p>";
            }
        }
        else {
            echo '<p id = "alert">Kérjük jelntkezz be a kosár használatához!</p>';
        }
        
    }

?>

<?php if ($product == false) : ?>
    <?php    require_once PRODUCT_DIR.'notfound.php'; ?>
<?php else: ?>
    <h2><?=$product['product_brand'].' '.$product['product_name']; ?></h2>
    <p class="category"><?=$product['category']; ?></p>

    <div class="product">
        <div class="row align-items-center">
            <div class="col">
                <div class="mainimg"><img src="<?=IMG_DIR.$product['picture']; ?>" class="img-fluid" alt="..."></a></div>
            </div>
            <div class="col">
                <div class="row justify-content-md-center">
                    <div class="col-md-3">
                    <p class = "price"><?=number_format($product['price']).' Ft'; ?></p>
                    </div>
                </div>
                <form method="POST">
                    <div class="form-row justify-content-md-center">
                        <div class="form-group col-md-2">
                           <input type ="number" class="form-control" id="productQuantity" name="quantity" value="1" required>
                           <input type ="hidden" class="form-control" id="productId" name="product_id" value=<?=$product['id']; ?>>
                        </div>
                        <div class="col-md-auto">
                            <button type="submit" class="btn btn-primary" name="toCart">Hozzáadás a kosárhoz</button>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <?='Raktáron: '.$product['in_stock'].' db'; ?>
                    </div>
                </form>
                <?php if (isUserLoggedIn() && $_SESSION['permission'] >= 1): ?>
                    <hr>
                    <div class="row justify-content-md-center">
                        <div class = "col-md-auto">
                        <a class="btn btn-primary" href="index.php?P=modifyProduct&ID=<?=$product['id'] ?>" role="button">Módosítás</a>
                        </div>
                        <div class = "col-md-auto">
                            <a class="btn btn-primary" href="index.php?P=product&d=<?=$product['id'] ?>" role="button">Törlés</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <h3 class="text-center">Leírás</h3>
                <p class="description"><?=$product['description']; ?></p>
            </div>
        </div>
    </div>

<?php endif; ?>