<?php

require_once("class/model/entity/comision/Main.php");

class ComisionEntity extends ComisionEntityMain {

  public function getFieldsNf(){
    $array = parent::getFieldsNf();
    array_push($array, Field::getInstanceRequire("comision","tramo"));
    array_push($array, Field::getInstanceRequire("comision","horario"));
    array_push($array, Field::getInstanceRequire("comision","periodo"));

    for($i = 0; $i < count($array); $i++){
      if($array[$i] instanceof FieldComisionUsuario) break;
    }
    if($i < count($array)) unset($array[$i]);

    /*for($i = 0; $i < count($array); $i++){
      if($array[$i] instanceof FieldComisionFecha) break;
    }
    if($i < count($array)) unset($array[$i]);*/

    return $array;
  }
}
