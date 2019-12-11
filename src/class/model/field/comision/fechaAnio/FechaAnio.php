<?php

require_once("class/model/field/comision/fechaAnio/Main.php");

class FieldComisionFechaAnio extends FieldComisionFechaAnioMain {

    public function __construct() {
        parent::__construct();
        $this->minLength = 2000;
    }
  
}
