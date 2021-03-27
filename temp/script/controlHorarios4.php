<?php
require_once("./config.php");
require_once("config/structure.php");
require_once("config/modelClasses.php");
require_once("config/valuesClasses.php");
require_once("class/controller/Dba.php");

function getValues($curso){
  return array (  
    "division" => new DivisionValues($curso["comision_"]["division_"]),
    "comision" => new ComisionValues($curso["comision_"]),
    "curso" => new CursoValues($curso),
    "carga_horaria" => new CargaHorariaValues($curso["carga_horaria_"]),
    "asignatura" => new AsignaturaValues($curso["carga_horaria_"]["asignatura_"]),
  );
}

$fechaAnio = filter_input(INPUT_GET, 'fecha_anio', FILTER_SANITIZE_SPECIAL_CHARS);
$fechaSemestre = filter_input(INPUT_GET, 'fecha_semestre', FILTER_SANITIZE_SPECIAL_CHARS);

$render = new Render();

$render->addAdvanced([
  ["com_fecha_anio","=",$fechaAnio], 
  ["com_fecha_semestre","=",$fechaSemestre], 
  ["com_autorizada","=", true]
]);

$render->setOrder(
  ["com_dvi_sed_numero" => "ASC", "com_anio"=>"ASC", "com_semestre"=>"ASC"]
);

$cursos = Dba::all("curso", $render);


$comision = null;
$plan = null;

for ($i = 0; $i < count($cursos); $i++) {
  if($comision != $cursos[$i]["comision"]) {
    $comision = $cursos[$i]["comision"];
    $anio =  $cursos[$i]["comision_"]["anio"];
    $semestre = $cursos[$i]["comision_"]["semestre"];
    $plan = $cursos[$i]["carga_horaria_"]["plan"];
    $errorPlan = false;
    $errorAnio = false;
    $errorSemestre = false;
  }

  if($cursos[$i]["carga_horaria_"]["plan"] != $plan) $errorPlan = true;
  if($cursos[$i]["comision_"]["anio"] != $anio) $errorAnio = true;
  if($cursos[$i]["comision_"]["semestre"] != $semestre) $errorSemestre = true;
  
  if($errorPlan || $errorAnio || $errorSemestre) {
    $v_ = getValues($cursos[$i]);
    echo "Control de " . $v_["asignatura"]->nombre() . " " . $v_["division"]->numero() . "/".$v_["comision"]->tramo();
    if($errorPlan) echo "<br>El plan no coincide";
    if($errorAnio) echo "<br>El año no coincide";
    if($errorSemestre) echo "<br>El semestre no coincide";
    echo "<br><br>";
  }

}



echo "Control de plan entre asignaturas de una comision finalizada";