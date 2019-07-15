<?php

require_once("class/model/field/comision/anio/Main.php");

class FieldComisionAnio extends FieldComisionAnioMain {
    public $subtype = "select_int";
    public $selectValues = array("1","2","3");
    public $main = true;
}
