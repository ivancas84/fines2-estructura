<?php

require_once("class/model/entity/comision/Main.php");

class ComisionEntity extends ComisionEntityMain {

    public function getFieldsNf(){
        $array = parent::getFieldsNf();
        array_push($array, new FieldComisionDias);
        array_push($array, new FieldComisionHoraInicio);
        array_push($array, new FieldComisionHoraFin);
        return $array;
    }
}
