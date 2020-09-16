<?php

require_once("class/model/Sql.php");

class DiaSql extends EntitySql {
    protected function orderDefault(){
        return ["numero" => "asc"];      
    }
    
}
