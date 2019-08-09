<?php

require_once("class/model/values/asignatura/Main.php");

//***** implementacion de Values para una determinada tabla *****
class AsignaturaValues extends AsignaturaValuesMain{

    public function codigoONombre($format = null) {
        if(!empty($this->codigo)) return $this->formatString($this->codigo, $format);    
        return $this->formatString($this->nombre, $format);
    }
}

