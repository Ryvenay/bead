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

?>