<?php

require_once("class/model/entity/division/Main.php");

class DivisionEntity extends DivisionEntityMain {
  
  public function getFieldsNf(){
    $array = parent::getFieldsNf();
    array_push($array, new FieldDivisionNumero);
    return $array;
  }
}
