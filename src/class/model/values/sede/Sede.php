<?php

require_once("class/model/values/sede/_Sede.php");

class Sede extends _Sede{
    public function nombre($modo = null) {
        switch($modo) {
            case "XX YY":
                return mb_strtoupper($this->nombre);

            default: return $this->nombre;
        }
        
    }

    public function tipo($modo = null) {
        switch($modo) {
            case "XX YY":
                return mb_strtoupper($this->tipo);

            default: return $this->tipo;
        }
        
    }


    public function backgroundDependencia(){

        if (($this->dependencia != "1532435439156616") AND (!empty($this->dependencia))) return "bg-success";


    }
}

