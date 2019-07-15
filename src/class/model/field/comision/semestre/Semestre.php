<?php

require_once("class/model/field/comision/semestre/Main.php");

class FieldComisionSemestre extends FieldComisionSemestreMain {
    public $subtype = "select_int";
    public $selectValues = array("0", "1", "2");
    public $main = true;
}
