<?php

require_once("class/model/values/horario/_Horario.php");

class Horario extends _Horario{
  
  public function totalMinutos(){
    return abs($this->horaFin->getTimestamp() - $this->horaInicio->getTimestamp()) / 60;
  }
  
  public function horasCatedra(){
    return $this->totalMinutos() / 40;
  }
}

