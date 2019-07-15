<?php
require_once("./config.php");
require_once("class/Filter.php");
require_once("config/structure.php");
require_once("config/modelClasses.php");
require_once("config/valuesClasses.php");
require_once("class/model/Dba.php");

function getValues($horario){
  return array (
    "horario" => new HorarioValues($horario),
    "division" => new DivisionValues($horario["curso_"]["comision_"]["division_"]),
    "comision" => new ComisionValues($horario["curso_"]["comision_"]),
    "curso" => new CursoValues($horario["curso_"]),
    "carga_horaria" => new CargaHorariaValues($horario["curso_"]["carga_horaria_"]),
    "asignatura" => new AsignaturaValues($horario["curso_"]["carga_horaria_"]["asignatura_"]),
  );
}
$fechaAnio = Filter::get("fecha_anio");
$fechaSemestre = Filter::get("fecha_semestre");
//$sqlo = HorarioSqlo::getInstance();
//$sql = $sqlo->all();
//echo "<pre>";
//echo $sql;

$render = new Render();

/*$comisiones = Dba::all("comision",
  [["fecha_anio","=",$fechaAnio], ["fecha_semestre","=",$fechaSemestre],["autorizada","=", true]]
);
$ids = array_column($comisiones, "id");
*/

$ids = Dba::ids("comision",
  [["fecha_anio","=",$fechaAnio], ["fecha_semestre","=",$fechaSemestre],["autorizada","=", true]]
);

$render = new Render();
$render->addAdvanced(["cur_comision","=",$ids]);
$render->setOrder(
  ["cur_com_dvi_sed_numero" => "ASC", "cur_com_anio"=>"ASC", "cur_com_semestre"=>"ASC", "curso"=>"ASC"]
);

$horarios = Dba::all("horario", $render);
$curso = null;
for($i = 0; $i < count($horarios); $i++){
  $v = getValues($horarios[$i]);

  if($curso != $v["curso"]->id()){
    if($curso) {
      $v_ = getValues($horarios[$i-1]);
      $minutos = $v_["carga_horaria"]->horasCatedra() * 40;
      if($minutos != $diferencia){
        echo "Control de " . $v_["asignatura"]->nombre() . " " . $v_["division"]->numero() . "/".$v_["comision"]->tramo();
        echo "<br>Minutos reloj: " . $minutos;
        echo "<br>Minutos definidos: " . $diferencia;
        echo "<br><br>";
      }
    }

    $curso = $v["curso"]->id();
    $diferencia = 0;
  }
  $minutos = $v["carga_horaria"]->horasCatedra() * 40;

  $interval = $v["horario"]->horaInicio->diff($v["horario"]->horaFin);

  $diferencia += $interval->h * 60;
  $diferencia += $interval->i;

}

echo "Control de minutos definidos finalizada";