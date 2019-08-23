<?php

require_once("class/model/entity/toma/Main.php");

class TomaEntity extends TomaEntityMain {
    public function getFieldsNf(){
        $array = parent::getFieldsNf();
        array_push($array, Field::getInstanceRequire("toma","fecha_desde"));
        array_push($array, Field::getInstanceRequire("toma","suma_horas_catedra"));
        return $array;
    }
}
