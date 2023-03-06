<?php


class AlumnoComisionRegistroScript {

    public function main(){
            $headers = (isset($_GET["headers"]))? $_GET["headers"] : "persona-apellidos, persona-nombres, persona-numero_documento, persona-fecha_nacimiento, persona-telefono"; 
            require_once("script/alumno_comision/registro.html");
    }
}