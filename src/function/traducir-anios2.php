<?php

  function traducirAnios2($anios, $anioIngreso){
    $anios_cursados = [];
    for($i = $anioIngreso; $i <= 3; $i++) {
      if(!key_exists($i, $anios) ||  $anios[$i] < 5) {
        switch($i){
          case 1: array_push($anios_cursados, "Primer"); break;
          case 2: array_push($anios_cursados, "Segundo"); break;
          case 3: array_push($anios_cursados, "Tercer"); break;
        }
      }
    }
    return $anios_cursados;
  }

  