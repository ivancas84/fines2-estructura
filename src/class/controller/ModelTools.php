<?php

class ModelTools {

  public static function intervaloAnterior(array $grupo){
    /**
     * un intervalo es la combinación de fecha_anio, fecha_semestre
     * @param $grupo["fecha_anio"]
     * @param $grupo["fecha_semestre"]
     */
    $param = $grupo;

    $param["fecha_anio"] = intval($grupo["fecha_anio"]);
    $param["fecha_semestre"] = intval($grupo["fecha_semestre"]);

    switch($param["fecha_semestre"]){
      case 2:  
        $param["fecha_semestre"] = 1; 
      break;
      case 1: 
        $param["fecha_anio"]--;
        $param["fecha_semestre"] = 2; 
      break;
      
      default: 
        $param["fecha_semestre"] = false;
        $param["fecha_anio"]--;
    }

    return $param;
  }
}