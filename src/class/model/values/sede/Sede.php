<?php

require_once("class/model/values/sede/Main.php");

//***** implementacion de Values para una determinada tabla *****
class SedeValues extends SedeValuesMain{
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

