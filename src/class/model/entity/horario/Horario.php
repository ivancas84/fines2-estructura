<?php

require_once("class/model/entity/horario/Main.php");

class HorarioEntity extends HorarioEntityMain {

    public function getFieldsNf(){
        $array = parent::getFieldsNf();
        array_push($array, new FieldHorarioHorasCatedra);
        return $array;
    }
      
}
