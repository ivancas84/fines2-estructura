<?php
require_once("./config.php");
require_once("class/Filter.php");
require_once("config/structure.php");
require_once("config/modelClasses.php");
require_once("config/valuesClasses.php");
require_once("class/model/Dba.php");

function getValues($comision){
  return array (
    "division" => new DivisionValues($comision["division_"]),
    "comision" => new ComisionValues($comision),
  );
}

$fechaAnio = Filter::getRequired("fecha_anio");
$fechaSemestre = Filter::getRequired("fecha_semestre");
$sqlo = ComisionSqlo::getInstance();
$sql = $sqlo->all([["fecha_anio","=",$fechaAnio],["fecha_semestre","=",$fechaSemestre]]);
$render = new Render();

$fechaSemestreAnterior = (intval($fechaSemestre) == 1) ? 2 : 1;
$fechaAnioAnterior = (intval($fechaSemestre) == 1) ? intval($fechaAnio) - 1 : $fechaAnio;


$render = new Render();
$render->setCondition([["fecha_anio","=",$fechaAnio], ["fecha_semestre","=",$fechaSemestre], ["tramo","!=","11"],["autorizada","=",true]]);
$render->setOrder(["dvi_numero" => "ASC"]);

$comisiones = Dba::all("comision", $render);

$render->setCondition([["fecha_anio","=",$fechaAnioAnterior], ["fecha_semestre","=",$fechaSemestreAnterior], ["tramo","!=","32"],["autorizada","=",true]]);

$comisionesAnteriores = Dba::all("comision", $render);

for($i = 0; $i < count($comisiones); $i++){
  for($j = 0; $j < count($comisionesAnteriores); $j++){
    $v = getValues($comisiones[$i]);
    $vA = getValues($comisionesAnteriores[$j]);

    if($v["comision"]->division() == $vA["comision"]->division()){
      if($v["comision"]->horario() != $vA["comision"]->horario()){
        echo "Control de " .  $v["division"]->numero() . "/". $v["comision"]->tramo() . ": " . $v["comision"]->horario();
        echo "<br>No coniciden horarios con " . $vA["division"]->numero() . "/". $vA["comision"]->tramo() . ": " . $vA["comision"]->horario();
        echo "<br><br>";
      }
    }
  }
}

echo "Control de coincidencia de horarios con el tramo anterior finalizada";