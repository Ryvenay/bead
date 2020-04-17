<?php
    if(!isUserLoggedIn() || $_SESSION['permission'] < 1) : ?>
        <?=$_SESSION['permission'] ?>
        <p id="alert">you have no power here</p>
    <?php else: ?>
        <form>
            <div class ="form-row">
                <div class="form-group">
                    <label for="productBrand">Termék márka</label>
                    <input type="text" class="form-control" id="productBrand" name="productBrand">
                    <label for="productName">Termék név</label>
                    <input type="text" class="form-control" id="productName" name="productName">
                </div>
                <div class="form-group">
                </div>
            </div>
        </form>
    <?php endif; ?>
    


