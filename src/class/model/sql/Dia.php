<?php

require_once("class/model/sql/_DiaSql.php");

class DiaSql extends _DiaSql {
    protected function orderDefault(){
        return ["numero" => "asc"];      
    }
    
}
