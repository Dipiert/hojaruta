<?php 
//namespace controllers;
//require(dirname(__FILE__) . "/../vendor/autoload.php");
//use DB;
//require("controllers/DBController.php");

class ItemController {

    private function prepareString($str) {
        return iconv('ISO-8859-1', 'UTF-8', $str);
    }

    public function prepareStrings($strs) {
        foreach ($strs as &$str) {
            $str = $this->prepareString($str);
        }
    }

}

