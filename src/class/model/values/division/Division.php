<?php

require_once("class/model/values/division/Main.php");

//***** implementacion de Values para una determinada tabla *****
class DivisionValues extends DivisionValuesMain{


    public function turnoLetra() { return substr($this->formatString($this->turno, "X Y"), 0 , 1); }

}

