<?php

require_once("class/model/entity/toma/Main.php");

class TomaEntity extends TomaEntityMain {
    public function getFieldsNf(){
        $array = parent::getFieldsNf();
        array_push($array, new FieldTomaFechaDesde);
        array_push($array, new FieldTomaSumaHorasCatedra);

        return $array;
    }
}
