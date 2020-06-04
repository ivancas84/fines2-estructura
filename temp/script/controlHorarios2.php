<?php
require_once("./config.php");
require_once("class/tools/Filter.php");
require_once("config/structure.php");
require_once("config/modelClasses.php");
require_once("config/valuesClasses.php");
require_once("class/controller/Dba.php");

function getValues($horario){
  return array (
    "horario" => new HorarioValues($horario),
    "dia" => new DiaValues($horario["dia_"]),
    "division" => new DivisionValues($horario["curso_"]["comision_"]["division_"]),
    "comision" => new ComisionValues($horario["curso_"]["comision_"]),
    "curso" => new CursoValues($horario["curso_"]),
    "carga_horaria" => new CargaHorariaValues($horario["curso_"]["carga_horaria_"]),
    "asignatura" => new AsignaturaValues($horario["curso_"]["carga_horaria_"]["asignatura_"]),
  );
}
$fechaAnio = Filter::getRequired("fecha_anio");
$fechaSemestre = Filter::getRequired("fecha_semestre");
$sqlo = ComisionSqlo::getInstance();
$sql = $sqlo->ids([["fecha_anio","=",$fechaAnio],["fecha_semestre","=",$fechaSemestre],["autorizada","=",true]]);
//echo $sql;
$render = new Render();

$ids = Dba::ids("comision",
  [["fecha_anio","=",$fechaAnio], ["fecha_semestre","=",$fechaSemestre], ["tramo",">","11"], ["autorizada","=",true]]
);
$render = new Render();
$render->addAdvanced(["cur_comision","=",$ids]);
$render->setOrder(
  ["cur_com_dvi_sed_numero" => "ASC", "cur_com_anio"=>"ASC", "cur_com_semestre"=>"ASC", "dia"=>"ASC", "hora_inicio"=>"ASC","hora_fin"=>"ASC"]
);

$horarios = Dba::all("horario", $render);

$comisionDia = null; //flag para verificar si cambia el curso o el dia
for($i = 0; $i < count($horarios); $i++) {
  $v = getValues($horarios[$i]);

  $comisionDia_ = $v["comision"]->id() .  $v["horario"]->dia();
  if($comisionDia == $comisionDia_){ //controlar superposicion o desfasaje
    /**
     * Si es el mismo curso y es el mismo dia se controla que la hora de fin del curso actual coincida con la hora de inicio del curso anterior
     */
     //echo "Control de " .  $v["division"]->numero() . "/". $v["comision"]->tramo();
     //echo "<br>No coniciden horarios de " . $v["asignatura"]->nombre() . " y " . $v_["asignatura"]->nombre();
     //echo "<br><br>";

     if($comisionDia) {
       $v_ = getValues($horarios[$i-1]);
       if($v_["horario"]->horaFin("H:i") != $v["horario"]->horaInicio("H:i")) {
         echo "Control de " .  $v_["division"]->numero() . "/". $v_["comision"]->tramo();
         echo "<br>No coniciden horarios de " . $v_["asignatura"]->nombre() . " (" . $v_["horario"]->horaFin("H:i") . ") y " . $v["asignatura"]->nombre() . " (" . $v["horario"]->horaInicio("H:i") . ") para el día " . $v["dia"]->dia();
         echo "<br><br>";
       }
     }
  } else { //reiniciar cursoDia
    $comisionDia = $comisionDia_;
  }
}

echo "Control de superposición horaria finalizada";