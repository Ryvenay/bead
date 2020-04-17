<?php
    $category = $_GET['category'];
    $items = getProductsByCategory($category);
?>

<h2><?=$category ?></h2>

<?php if(count($items) == 0) : ?>
    <p id="alert">Nincs elem ebben a kategóriában!</p>
<?php else: ?>
    <div class = "row">
        <?php foreach ($items as $item): ?>
            <div class = "col">
                <div class="card border-white" style="width: 18rem;">
                    <a href="index.php?P=product&ID=<?=$item['id'] ?>"><img src="<?=IMG_DIR.$item['picture']; ?>" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title"><?=$item['product_brand'].' '.$item['product_name'] ?></h5>
                        <h6 class="card-subtitle text-muted"><?=number_format($item['price']).' Ft'?></h6>
                        <p class="card-text"><?=$item['shortdesc']; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif; ?>