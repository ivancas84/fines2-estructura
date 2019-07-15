<?php

require_once("class/model/values/cargaHoraria/Main.php");

//***** implementacion de Values para una determinada tabla *****
class CargaHorariaValues extends CargaHorariaValuesMain{

    public function horasReloj(){
        $minutos =intval($this->horasCatedra) * 40;

       
        $hours = floor($minutos  / 60);
        $minutes = ($minutos % 60);
        return sprintf('%02d:%02d', $hours, $minutes);
    }
}

