<?php
    if(array_key_exists('ID', $_GET) && !empty($_GET['ID'])) {
        $ID = $_GET['ID'];
        $query = "SELECT * FROM products WHERE id = :id";
        $params = [
            ':id' => $ID
        ];

        require_once DATABASE_CONTROLLER;
        $product = getRecord($query, $params);
        if (empty($product)) {
            header('Location: index.php');
        }
        else {
            $postData = [
                'id' => $ID,
                'productBrand' => $product['product_brand'],
                'productName' => $product['product_name'],
                'price' => $product['price'],
                'category' => $product['category'],
                'inStock' => $product['in_stock'],
                'shortDesc' => $product['shortdesc'],
                'description' => $product['description']
            ];
        }
    }
?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modify'])) {
        $postData = [
            'id' => $ID,
            'productBrand' => $_POST['brand'],
            'productName' => $_POST['name'],
            'price' => $_POST['price'],
            'category' => $_POST['category'],
            'inStock' => $_POST['inStock'],
            'shortDesc' => $_POST['shortDesc'],
            'description' => $_POST['description']
        ];

        $picture = $_FILES['picture'];

        if (empty($postData['productBrand']) || empty($picture) || empty($postData['productName']) || empty($postData['price']) || empty($postData['category']) || empty($postData['inStock']) || empty($postData['shortDesc']) || empty($postData['description'])) {
            echo '<p id="alert">Hiányzó adat!</p>';
        }
        else {
                echo modifyProduct($postData['id'], $postData['productBrand'], $postData['productName'], $postData['category'], $postData['price'], $postData['inStock'], $picture, $postData['shortDesc'], $postData['description']);
            
        }
    }
?>

<?php if(!isUserLoggedIn() || $_SESSION['permission'] < 1) : ?>
    <p id="alert">you have no power here</p>
<?php else: ?>
    <h2>Termék módosítás</h2>
    <form method = "POST" enctype="multipart/form-data">
        <div class ="form-row justify-content-md-center">
            <div class = "form-group col-md-8">
                <label for="productBrand">Termék márka:</label>
                <input type="text" class="form-control" id="productBrand" name="brand" value="<?=isset($postData) ? $postData['productBrand'] : "";?>" required>
                <label for="productName">Termék név:</label>
                <input type="text" class="form-control" id="productName" name="name" value="<?=isset($postData) ? $postData['productName'] : "";?>" required>
            </div>
        </div>
        <div class ="form-row justify-content-md-center">
            <div class = "form group col-md-2">
                <label for="productPrice">Ár:</label>
                <input type="number" class="form-control" id="productPrice" name="price" value="<?=isset($postData) ? $postData['price'] : "";?>" required>
            </div>
            <div class = "form group col-md-6">
                <label for="productCategory">Kategória:</label>
                <select class="form-control" id="productCategory" name = "category" value="<?=isset($postData) ? $postData['category'] : "";?>" required>
                    <option>Gitár</option>
                    <option>Effekt</option>
                    <option>Erősítő</option>
                    <option>Kiegészítő</option>
                </select>
            </div>
        </div>
        <div class ="form-row justify-content-md-center">
            <div class = "form group col-md-2">
                <label for="productInStock">Raktáron:</label>
                <input type="number" class="form-control" id="productInStock" name="inStock" value="<?=isset($postData) ? $postData['inStock'] : "";?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="productPicture">Kép:</label>
                <input type="file" class="form-control-file" id="productPicture" name="picture" requierd>
            </div>
        </div>
        <div class ="form-row justify-content-md-center">
            <div class = "form group col-md-8">
                <label for="productShortDesc">Rövid leírás:</label>
                <input type="text" class="form-control" id="productShortDesc" name="shortDesc" maxlength="80" value="<?=isset($postData) ? $postData['shortDesc'] : "";?>" required>
            </div>
        </div>
        <div class ="form-row justify-content-md-center">
            <div class = "form group col-md-8">
                <label for="productDescription">Részletes leírás:</label>
                <textarea class="form-control" id="productDescription" rows="3" name="description" required><?=isset($postData) ? $postData['description'] : "";?></textarea>
            </div>
        </div>
        <div class ="form-row justify-content-md-center">
            <div class="col-md-auto">
                <button type="submit" class="btn btn-primary" id="addButton" name="modify">Módosítás</button>
            </div>
        </div>
        
    </form>
<?php endif; ?>