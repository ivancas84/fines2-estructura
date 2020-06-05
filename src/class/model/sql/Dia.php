<?php

require_once("class/model/sql/_Dia.php");

class DiaSql extends _DiaSql {
    protected function orderDefault(){
        return ["numero" => "asc"];      
    }
    
}
