<?php

require_once("class/model/entity/comision/Main.php");

class ComisionEntity extends ComisionEntityMain {

  public function getFieldsNf(){
    $array = parent::getFieldsNf();
    array_push($array, new FieldComisionTramo);
    array_push($array, new FieldComisionHorario);
    array_push($array, new FieldComisionPeriodo);


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
