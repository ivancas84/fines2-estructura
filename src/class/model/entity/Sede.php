<?php

require_once("class/model/entity/_sede.php");

class SedeEntity extends _SedeEntity  {

  public function getFieldsNf(){
    $array = parent::getFieldsNf();

    for($j = 0; $j < 2; $j++){
      for($i = 0; $i < count($array); $i++){
        if($array[$i] instanceof FieldSedeAlta) break;
      }
      if($i < count($array)) unset($array[$i]);
      $array = array_values($array);
    }

    return $array;
  }

  public function getFieldsFk(){
    $array = parent::getFieldsFk();
    array_push($array, Field::getInstanceRequire("sede","coordinador"));
    //array_push($array, Field::getInstanceRequire("sede","referente"));

    return $array;
  }
}
