<?php

require_once("class/model/sqlo/sede/Main.php");

//***** implementacion de Sqlo para una determinada tabla *****
class SedeSqlo extends SedeSqloMain{

  public function idAutorizadaFecha($fecha){ //TEMPORAL HASTA IMPLEMENTAR CORRECTAMENTE ANIO TRAMO DEPENDENCIA PLAN
    /**
     * id de sedes autorizadas en una determinada fecha
     */
    return "
SELECT DISTINCT sede.id
FROM sede
INNER JOIN division ON (division.sede = sede.id)
INNER JOIN comision ON (comision.division = division.id)
WHERE comision.fecha = '{$fecha}'
AND comision.autorizada
";
  }






}
