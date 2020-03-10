<?php

require_once("class/model/sql/dia/Main.php");

class DiaSql extends DiaSqlMain {
    protected function orderDefault(){
        return ["numero" => "asc"];      
    }
    
}
