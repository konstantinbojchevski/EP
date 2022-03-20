<?php

require_once 'model/AbstractDB.php';

class LapshopDB extends AbstractDB {

    public static function get(array $id) {
        $laptops = parent::query("SELECT item_id, item_brand, item_name, item_price, item_desc"
                        . " FROM product"
                        . " WHERE item_id = :id", $id);

        if (count($laptops) == 1) {
            return $laptops[0];
        } else {
            throw new InvalidArgumentException("No such product");
        }
    }

    public static function getAll() {
        return parent::query("SELECT item_id, item_brand, item_name, item_price, item_desc"
                        . " FROM product"
                        . " ORDER BY item_id ASC");
    }

    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT  item_id, item_brand, item_name, item_price, item_desc, "
                        . "          CONCAT(:prefix, item_id) as uri "
                        . "FROM product "
                        . "ORDER BY item_id ASC", $prefix);
    }

}
