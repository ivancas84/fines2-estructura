<?php

require_once("class/model/values/horario/Main.php");

//***** implementacion de Values para una determinada tabla *****
class HorarioValues extends HorarioValuesMain{
  
  public function totalMinutos(){
    return abs($this->horaFin->getTimestamp() - $this->horaInicio->getTimestamp()) / 60;
  }
  
  public function horasCatedra(){
    return $this->totalMinutos() / 40;
  }
}

