<?php

require_once("class/model/entity/cargaHoraria/Main.php");

class CargaHorariaEntity extends CargaHorariaEntityMain {
  public $identifier = ["asi_nombre", "pla_orientacion"];

  public function getFieldsNf(){
    $array = parent::getFieldsNf();
    array_push($array, Field::getInstanceRequire("carga_horaria","tramo"));
    return $array;
  }
}
