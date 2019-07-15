<?php

require_once("function/dependencias.php");

function id_dependencia_numero($numero){
    return array_flip(dependencias())[$numero];    
}