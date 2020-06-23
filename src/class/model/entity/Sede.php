<?php

require_once("class/model/entity/_Sede.php");

class SedeEntity extends _SedeEntity  {
 
  public function getFieldsFk(){
    $array = parent::getFieldsFk();
    array_push($array, Field::getInstanceRequire("sede","coordinador"));
    //array_push($array, Field::getInstanceRequire("sede","referente"));

    return $array;
  }

  public function getFieldsUniqueMultiple(){ 
    return array(
      Field::getInstanceRequire("sede", "numero"),
      Field::getInstanceRequire("sede", "centro_educativo"),
    ); 
  }
}
