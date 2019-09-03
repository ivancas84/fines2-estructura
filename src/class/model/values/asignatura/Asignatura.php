<?php

require_once("class/model/values/asignatura/_Asignatura.php");

//***** implementacion de Values para una determinada tabla *****
class Asignatura extends _Asignatura{

    public function codigoONombre($format = null) {
        if(!empty($this->codigo)) return $this->formatString($this->codigo, $format);    
        return $this->formatString($this->nombre, $format);
    }
}

