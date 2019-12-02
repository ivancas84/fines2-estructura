<?php

require_once("class/model/values/asignatura/_Asignatura.php");

//***** implementacion de Values para una determinada tabla *****
class Asignatura extends _Asignatura{

    public function codigoONombre($format = null) {
        if(!Validation::is_empty($this->codigo)) return $this->codigo($format);    
        return $this->nombre($format);
    }
}

