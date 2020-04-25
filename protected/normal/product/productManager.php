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
            return '<p id="alert"> A fájl nem kép!</p>';
        }
        else if (file_exists($pictureTargetFile)) {
            return '<p id="alert">A fálj már létezik!</p>';
        }
        else if ($picture["size"] > 500000) {
            return '<p id="alert">A file túl nagy!</p>';
        }
        else if ($pictureFileType != "jpg" && $pictureFileType != "png" && $pictureFileType != "jpeg") {
            return '<p id="alert">Nem megfelelő fájl formátum!</p>';
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
                return '<p id="info">A termék hozzáadva!</p>';
                
            }
            return '<p id="alert">Hiba a termék hozzáadása közben!';
        }
        else {
            return '<p id="alert">Hiba a fájlfeltöltés során!';
        }

    }

    function deleteProduct($id) {
        require_once DATABASE_CONTROLLER;
        $query = "SELECT picture FROM products WHERE id = :id";
        $params = [
            ':id' => $id
        ];

        $picture = getRecord($query, $params);

        unlink(IMG_DIR.$picture['picture']);
            
        $query = "DELETE FROM products WHERE id = :id";

        if (executeDML($query, $params)) {
            return true;
        }
        else {
            return false;
        }
    }

    function modifyProduct($id, $productBrand, $productName, $category, $price, $inStock, $picture, $shortDesc, $description) {
        
        if(empty($picture)) {
            $pictureTargetFile = IMG_DIR.basename($picture['name']);
            $pictureFileType = strtolower(pathinfo($pictureTargetFile,PATHINFO_EXTENSION));

            if (!getimagesize($picture["tmp_name"])) {
                return '<p id="alert"> A fájl nem kép!</p>';
            }
            else if (file_exists($pictureTargetFile)) {
                return '<p id="alert">A fálj már létezik!</p>';
            }
            else if ($picture["size"] > 500000) {
                return '<p id="alert">A file túl nagy!</p>';
            }
            else if ($pictureFileType != "jpg" && $pictureFileType != "png" && $pictureFileType != "jpeg") {
                return '<p id="alert">Nem megfelelő fájl formátum!</p>';
            }
            else if (move_uploaded_file($picture["tmp_name"], $pictureTargetFile)) {
                $query = "UPDATE products (product_brand, product_name, category, price, in_stock, picture, shortdesc, description) VALUES (:productBrand,:productName,:category,:price,:inStock,:picture,:shortDesc,:description) WHERE id = :id";
                $params = [
                    ':id' => $id,
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
                    return '<p id="info">A termék módosítva!</p>';
                }
            }
        } 
        else {
            $query = "UPDATE products (product_brand, product_name, category, price, in_stock, shortdesc, description) VALUES (:productBrand,:productName,:category,:price,:inStock,:shortDesc,:description) WHERE id = :id";
                $params = [
                    ':id' => $id,
                    ':productBrand' => $productBrand,
                    ':productName' => $productName,
                    ':category' => $category,
                    ':price' => $price,
                    ':inStock' => $inStock,
                    ':shortDesc' => $shortDesc,
                    ':description' => $description
                ];
                require_once DATABASE_CONTROLLER;
            
                if(executeDML($query, $params)) {
                    return '<p id="info">A termék módosítva!</p>';
                }
        }
        
    }


?>