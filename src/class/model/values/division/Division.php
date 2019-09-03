<?php

require_once("class/model/values/division/_Division.php");

class Division extends _Division{


    public function turnoLetra() { return substr($this->formatString($this->turno, "X Y"), 0 , 1); }

}

