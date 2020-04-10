<?php
    function getProduct($id) {
        $query = "SELECT id, product_brand, product_name, category, price, in_stock, picture, description FROM products WHERE id = :id";
        $params = [
            ':id' => $_GET['ID']
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

?>