<?php

require_once("class/model/values/cargaHoraria/_CargaHoraria.php");

//***** implementacion de Values para una determinada tabla *****
class CargaHoraria extends _CargaHoraria{

    public function horasReloj(){
        $minutos =intval($this->horasCatedra) * 40;

       
        $hours = floor($minutos  / 60);
        $minutes = ($minutos % 60);
        return sprintf('%02d:%02d', $hours, $minutes);
    }
}

