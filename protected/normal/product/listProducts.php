<?php
    $category = $_GET['category'];
    $items = getProductsByCategory($category);
?>


<h2><?=$category ?></h2>


<div class = "row" id="filter">
    <div class = "col-md-12">
        <form method = "GET">
            <div class = "form-row">
                <div class="form-group col-md-2">
                    <input type="text" name="brand" class="form-control form-control-sm" id="brand" placeholder = "Márka">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" name="product" class="form-control form-control-sm" id="product" placeholder = "Termék">
                </div>
                <div class="form-group col-md-2">
                    <select class="form-control form-control-sm" name="category">
                        <option value = "">Összes</option>
                        <option>Gitár</option>
                        <option>Effekt</option>
                        <option>Erősítő</option>
                        <option>Kiegészítő</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <input type="number" name="minPrice" class="form-control form-control-sm" id="minPrice" placeholder = "Min. ár">
                </div>
                <div class="form-group col-md-2">
                    <input type="number" name="maxPrice" class="form-control form-control-sm" id="maxPrice" placeholder = "Max. ár">
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" value ="search" class="btn btn-primary btn-sm" id="searchButton" name="P">Keresés</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php if(count($items) == 0) : ?>
    <p id="alert">Nincs elem ebben a kategóriában!</p>
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