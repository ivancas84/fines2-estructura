<?php

require_once("class/model/entity/cargaHoraria/Main.php");

class CargaHorariaEntity extends CargaHorariaEntityMain {
    public function getFieldsNf(){
        $array = parent::getFieldsNf();
        array_push($array, new FieldCargaHorariaTramo());
        return $array;
      }
}
