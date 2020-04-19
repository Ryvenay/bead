<?php
    function getProduct($id) {
        $query = "SELECT id, product_brand, product_name, category, price, in_stock, picture, description FROM products WHERE id = :id";
        $params = [
            ':id' => $id
        ];

        require_once DATABASE_CONTROLLER;
        $record = getRecord($query, $params);

        if(empty($record)) {
            return false;
        }
        else {
            return $record;
        }
    }

    function toCart($id, $quantity) {
        $query = "SELECT id, in_stock FROM products WHERE id = :id";
        $params = [
            ':id' => $id
        ];
        require_once DATABASE_CONTROLLER;
        $record = getRecord($query, $params);

        if (empty($record) || $record['in_stock'] < $quantity) {
            return false;
        }
        else {
            $query ="INSERT INTO cart VALUES(:user_id, :product_id, :quantity) ON DUPLICATE KEY UPDATE  quantity = :quantity";
            $params = [
                ':user_id' => $_SESSION['uid'],
                ':product_id' => $id,
                ':quantity' => $quantity
            ];
        }

        if(executeDML($query, $params)) 
			return true;
    }

    function removeFromCart($id) {
        $query = "DELETE FROM cart WHERE product_id = :id";
        $params = [
            ':id' => $id
        ];

        require_once DATABASE_CONTROLLER;

        if(executeDML($query, $params)) {
            return true;
        }
    }

    function getProductsByCategory($category) {
        $query = "SELECT * FROM products WHERE category = :category";
        $params = [
            ':category' => $category
        ];

        require_once DATABASE_CONTROLLER;
        return getList($query, $params);
    }

    function addProduct($productBrand, $productName, $category, $price, $inStock, $picture, $shortDesc, $description) {

        $pictureTargetFile = IMG_DIR.basename($picture['name']);
        $pictureFileType = strtolower(pathinfo($pictureTargetFile,PATHINFO_EXTENSION));

        if (!getimagesize($picture["tmp_name"])) {
            return "A fájl nem kép!";
        }
        else if (file_exists($pictureTargetFile)) {
            return "A fálj már létezik!";
        }
        else if ($picture["size"] > 500000) {
            return "A file túl nagy!";
        }
        else if ($pictureFileType != "jpg" && $pictureFileType != "png" && $pictureFileType != "jpeg") {
            return "Nem megfelelő fájl formátum!";
        }
        else if (move_uploaded_file($picture["tmp_name"], $pictureTargetFile)) {
            $query = "INSERT INTO products (product_brand, product_name, category, price, in_stock, picture, shortdesc, description) VALUES (:productBrand,:productName,:category,:price,:inStock,:picture,:shortDesc,:description)";
            $params = [
                ':productBrand' => $productBrand,
                ':productName' => $productName,
                ':category' => $category,
                ':price' => $price,
                ':inStock' => $inStock,
                ':picture' => basename($picture['name']),
                ':shortDesc' => $shortDesc,
                ':description' => $description
            ];

            require_once DATABASE_CONTROLLER;
        
            if(executeDML($query, $params)) {
                return "A termék hozzáadva!";
                
            }
            return "Hiba a termék hozzáadása közben!";
        }
        else {
            return "Hiba a fájlfeltöltés során!";
        }

    }

?>