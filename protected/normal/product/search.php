<?php 
    $filter = [];
    array_key_exists('brand', $_GET) && !empty($_GET['brand']) ? $filter['product_brand'] = $_GET['brand'] : NULL;
    array_key_exists('product', $_GET) && !empty($_GET['product']) ? $filter['product_name'] = $_GET['product'] : NULL;
    array_key_exists('category', $_GET) && !empty($_GET['category']) ? $filter['category'] = $_GET['category'] : NULL;
    array_key_exists('minPrice', $_GET) && !empty($_GET['minPrice']) ? $filter['min'] = $_GET['minPrice'] : NULL;
    array_key_exists('maxPrice', $_GET) && !empty($_GET['maxPrice']) ? $filter['max'] = $_GET['maxPrice'] : NULL;

    $items = searchProducts($filter);
    //echo $items;
    /*foreach($items as $key => $value) {
        echo $key." ".$value."<br>";
    } */
    
?>
<h2>Keresés</h2>
<div class = "row" id="filter">
    <div class = "col-md-12">
        <form method = "GET">
            <div class = "form-row">
                <div class="form-group col-md-2">
                    <input type="text" name="brand" class="form-control form-control-sm" id="brand" placeholder = "Márka" value = "<?= isset($filter) && array_key_exists('product_brand', $filter) ? $filter['product_brand'] : ""; ?>">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" name="product" class="form-control form-control-sm" id="product" placeholder = "Termék"  value = <?= isset($filter) && array_key_exists('product_name', $filter) ? $filter['product_name'] : ""; ?>>
                </div>
                <div class="form-group col-md-2">
                    <select class="form-control form-control-sm" name="category">
                        <option value = "">Összes</option>
                        <option <?= isset($filter) && array_key_exists('category', $filter) && $filter['category'] == "Gitár" ? "Selected" : NULL; ?>>Gitár</option>
                        <option <?= isset($filter) && array_key_exists('category', $filter) && $filter['category'] == "Effekt" ? "Selected" : NULL; ?>>Effekt</option>
                        <option <?= isset($filter) && array_key_exists('category', $filter) && $filter['category'] == "Erősítő" ? "Selected" : NULL; ?>>Erősítő</option>
                        <option <?= isset($filter) && array_key_exists('category', $filter) && $filter['category'] == "Kiegészítő" ? "Selected" : NULL; ?>>Kiegészítő</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <input type="number" name="minPrice" class="form-control form-control-sm" id="minPrice" placeholder = "Min. ár"  value = <?= isset($filter) && array_key_exists('min', $filter) ? $filter['min'] : ""; ?>>
                </div>
                <div class="form-group col-md-2">
                    <input type="number" name="maxPrice" class="form-control form-control-sm" id="maxPrice" placeholder = "Max. ár"  value = <?= isset($filter) && array_key_exists('max', $filter) ? $filter['max'] : ""; ?>>
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" value ="search" class="btn btn-primary btn-sm" id="searchButton" name="P">Keresés</button>
                </div>
            </div>
        </form>
    </div>
</div>



<?php if(count($items) == 0) : ?>
    <p id="alert">Nincs találat!</p>
<?php else: ?>
    <div class = "row">
        <?php foreach ($items as $item): ?>
            <div class = "col">
                <div class="card border-white" style="width: 15rem;">
                    <a href="index.php?P=product&ID=<?=$item['id'] ?>"><div class="prwimg"><img src="<?=IMG_DIR.$item['picture']; ?>" class="card-img-top" alt="..."></div></a>
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
