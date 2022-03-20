<?php

require_once("model/LapshopDB.php");
require_once("ViewHelper.php");

class LaptopsController {

    public static function get($id) {
        echo ViewHelper::render("view/laptop-detail.php", LapshopDB::get(["id" => $id]));
    }

    public static function index() {
        echo ViewHelper::render("view/laptop-list.php", [
            "laptops" => LapshopDB::getAll()
        ]);
    }

    /**
     * Returns TRUE if given $input array contains no FALSE values
     * @param type $input
     * @return type
     */
    public static function checkValues($input) {
        if (empty($input)) {
            return FALSE;
        }

        $result = TRUE;
        foreach ($input as $value) {
            $result = $result && $value != false;
        }

        return $result;
    }

    /**
     * Returns an array of filtering rules for manipulation books
     * @return type
     */
    public static function getRules() {
        return [
            'brand' => FILTER_SANITIZE_SPECIAL_CHARS,
            'name' => FILTER_SANITIZE_SPECIAL_CHARS,
            'description' => FILTER_SANITIZE_SPECIAL_CHARS,
            'price' => FILTER_VALIDATE_FLOAT
            
        ];
    }

}
