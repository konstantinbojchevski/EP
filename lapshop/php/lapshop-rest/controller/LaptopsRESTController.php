<?php

require_once("model/LapshopDB.php");
require_once("controller/LaptopsController.php");
require_once("ViewHelper.php");

class LaptopsRESTController {

    public static function get($id) {
        try {
            echo ViewHelper::renderJSON(LapshopDB::get(["id" => $id]));
        } catch (InvalidArgumentException $e) {
            echo ViewHelper::renderJSON($e->getMessage(), 404);
        }
    }

    public static function index() {
        $prefix = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]
                . $_SERVER["REQUEST_URI"];
        echo ViewHelper::renderJSON(LapshopDB::getAllwithURI(["prefix" => $prefix]));
    }
    
}
