<?php
require_once("function/dependencias.php");

function numero_dependencia_abr_id($id){
    return substr(dependencias()[$id], -2);

}