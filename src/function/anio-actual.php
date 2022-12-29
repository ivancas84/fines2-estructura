<?php

 function anioActual($anios, $anioIngreso){
    $anios_cursados = [];
    
    for($i = $anioIngreso; $i <= 3; $i++) {
      if(!key_exists($i, $anios)) continue;
      else break;
    }

    switch($i){
      case 1: return "Primero";
      case 2: return "Segundo";
      default: return "Tercero";
    }
  }
