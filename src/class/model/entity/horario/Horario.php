<?php

require_once("class/model/entity/horario/Main.php");

class HorarioEntity extends HorarioEntityMain {

    public function getFieldsNf(){
        $array = parent::getFieldsNf();
        array_push($array, Field::getInstanceRequire("horario","horas_catedra"));
        return $array;
    }
      
}
