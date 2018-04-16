<?php 

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

