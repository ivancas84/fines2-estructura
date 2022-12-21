<?php

function sumaDisposicionesPorAnio($disposicionesRestantes){
    /**
     * sumar por anio las disposiciones que faltan, con esa info se puede cal-
     * cular los años cursados.
     * 
     * [
     *   1 => 2
     *   2 => 3
     *   3 => 1
     * ] 
     */
    $anios = [];
    foreach($disposicionesRestantes as $dr){
      if(!key_exists($dr["planificacion-anio"], $anios)) {
        $anios[$dr["planificacion-anio"]] = 1;
      }
      else {
        $anios[$dr["planificacion-anio"]]++;
      }
    }

    return $anios;
  }
