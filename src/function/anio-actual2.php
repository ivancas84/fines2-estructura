
<?php
  function anioActual2($anios){
    if(!rsort($anios)) throw new Exception("Error al ordenar");
    $i = (count($anios)) ? $anios[0] : 1;

    switch($i){
      case 1: return "Primero";
      case 2: return "Segundo";
      default: return "Tercer";
    }
  }