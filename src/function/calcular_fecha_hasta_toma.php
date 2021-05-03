<?php


/**
 * Ejemplo
 * $fechaLimiteDiciembre = DateTime::createFromFormat("Y-m-d h:i:s:u", "2020-12-31 00:00:00:000000");
 * $fechaLimiteMarzo = DateTime::createFromFormat("Y-m-d h:i:s:u", "2021-03-31 00:00:00:000000");
 * $sumaDiciembre = 4;
 * $sumaMarzo = 5; //no se considera enero de vacaciones
 * calcular($toma, $sumaDiciembre, $fechaLimiteDiciembre, $sumaMarzo, $fechaLimiteMarzo)
 */
function calcular(array $row, $suma, DateTime $fechaLimite = null, $suma2 = null, DateTime $fechaLimite2 = null){
  $r = $container->getRel("toma")->value($row);
  $fechaToma = $r["toma"]->_get("fecha_toma");
  $fechaFin = clone $fechaToma;
  $fechaFin->modify("+ " . $suma . " month");
  $r["continua"] = true;
  $r["horas_adicionales"] = 0;

  $arr = explode(' ',trim($r["docente"]->_get("nombres","Xx Yy")));
  $r["primer_nombre"] = $arr[0]; 
  $r["turno"] = (acronym($r["comision"]->_get("turno"))=="N") ? "V":acronym($r["comision"]->_get("turno"));

  if(!$fechaLimite) return $r;
  
  if($fechaLimite && $fechaFin->getTimestamp() <= $fechaLimiteDiciembre->getTimestamp()) {
    $r["continua"] = false;
    return;
  } 
  
  $r["fecha_fin"] = clone $fechaToma;
  $r["fecha_fin"]->modify("+ 5 month");
  if($r["fecha_fin"]->getTimestamp() > $fechaLimiteMarzo->getTimestamp()){
    
    $diferencia = $r["fecha_fin"]->diff($fechaLimiteMarzo)->days;
    //$diferencia = round($r["fecha_fin"]->diff($fechaLimiteMarzo)->days / 7, 0, PHP_ROUND_HALF_UP);
    $r["fecha_fin"] = clone $fechaLimiteMarzo;
    $r["horas_adicionales"] = $diferencia * intval($r["curso"]->_get("horas_catedra"));
    $r["fecha_inicio_horas_adicionales"] = clone $fechaLimiteMarzo;
    $r["fecha_inicio_horas_adicionales"]->modify("- {$diferencia} day");
    //$r["fecha_inicio_horas_adicionales"]->modify("- {$diferencia} week");
  }
  return $r;
}