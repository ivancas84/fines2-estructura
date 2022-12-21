<?php

  function traducirAnios($anios){
    $anios_cursados = [];
    for($i = $this->alumno["anio_ingreso"]; $i <= 3; $i++) {
      if(!key_exists($i, $anios) ||  $anios[$i] < 5) {
        switch($i){
          case 1: array_push($anios_cursados, "Primero"); break;
          case 2: array_push($anios_cursados, "Segundo"); break;
          case 3: array_push($anios_cursados, "Tercero"); break;
        }
      }
    }
    return $anios_cursados;
  }