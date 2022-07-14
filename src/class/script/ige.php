<?php

require_once("../config/config.php");
require_once("class/Container.php");
require_once("class/model/Render.php");
require_once("function/array_group_value.php");
require_once("function/array_combine_key.php");

$container = new Container();

$render = new Render();
$render->setCondition([
  ["cur_com_cal-anio","=","2020"],
  ["cur_com_cal-semestre","=","2"],
  //["cur_com_sed-centro_educativo","=","1"],
]);
$render->setSize(false);
$render->setOrder(["cur_com_sed-numero"=>"ASC","cur_com-division"=>"ASC"]);
$horarios = $container->getDb()->all("horario",$render);

$render = new Render();
$render->setCondition([
  ["cur_com_cal-anio","=","2020"],
  ["cur_com_cal-semestre","=","2"],
  ["cur_com_sed-centro_educativo","=","1"],
  ["estado","=","Aprobada"],
  ["estado_contralor","=","Pasar"]
]);
$render->setSize(false);
$render->setOrder(["doc-nombres"=>"ASC","doc-apellidos"=>"ASC"]);
$docentes = $container->getDb()->all("toma",$render);
$curso_docentes = array_combine_key($docentes, "curso");

$comision_horarios = array_group_value($horarios, "cur_comision");

$comision_cursos_horarios = [];
$cursos_horarios = [];
foreach($comision_horarios as $key => $horarios_comision){
  $comision_cursos_horarios[$key] = array_group_value($horarios_comision, "curso");
}

foreach($comision_cursos_horarios as $comision => $cursos){
  foreach($cursos as $curso => $horarios){
    $cursos_horarios[$curso] = ["","","","",""];
    foreach($horarios as $horario){
      $h = $container->getRel("horario")->value($horario);
      switch($h["dia"]->_get("numero")){
        case "0":
          $cursos_horarios[$curso][0] = $h["horario"]->_get("hora_inicio", "H:i") . " a " . $h["horario"]->_get("hora_fin","H:i");
        break;
        case "1":
          $cursos_horarios[$curso][1] = $h["horario"]->_get("hora_inicio", "H:i"). " a " . $h["horario"]->_get("hora_fin","H:i");
        break;
        case "2":
          $cursos_horarios[$curso][2] = $h["horario"]->_get("hora_inicio", "H:i"). " a " . $h["horario"]->_get("hora_fin","H:i");
        break;
        case "3":
          $cursos_horarios[$curso][3] = $h["horario"]->_get("hora_inicio", "H:i"). " a " . $h["horario"]->_get("hora_fin","H:i");
        break;
        case "4":
          $cursos_horarios[$curso][4] = $h["horario"]->_get("hora_inicio", "H:i"). " a " . $h["horario"]->_get("hora_fin","H:i");
        break;
      }  
    }
  }
}

?>

<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>
<table>
  <tr>
    <th>REGION</th>
    <th>DISTRITO</th>
    <th>CENS</th>
    <th>SEDE</th>
    <th>DIRECCIÓN</th>
    <th>COMISIÓN</th>
    <th>CONFIGURACIÓN</th>
    <th>ORIENTACIÓN</th>
    <th>AÑO-CUATRIMESTRE</th>
    <th>TURNO</th>
    <th>ESTUDIANTES</th>
    <th>MATERIA</th>
    <th>CODIGO LISTADO FINES</th>
    <th>HS.C</th>
    <th>LUNES</th>
    <th>MARTES</th>
    <th>MIÉRCOLES</th>
    <th>JUEVES</th>
    <th>VIERNES</th>
    <th>ID COMISION</th>
    <th>APELLIDO</th>
    <th>NOMBRE</th>
    <th>CUIL</th>
    <th>FECHA DE NACIMIENTO</th>
  </tr>
<? foreach($comision_cursos_horarios as $comision => $cursos):
  $first = true;
  $first2 = true;
  foreach($cursos as $curso => $horarios): 
    $d = $container->getRel("horario")->value($horarios[0]);
    $h = $container->getRel("horario")->value($horarios[0]) ?>
  <tr>
    <?if($first): $first = false; ?>
    <td rowspan="<?=count($cursos)?>">1</td>
    <td rowspan="<?=count($cursos)?>">LA PLATA</td>
    <td rowspan="<?=count($cursos)?>">456</td>
    <td rowspan="<?=count($cursos)?>"><?=$d["sede"]->_get("nombre")?></td>
    <td rowspan="<?=count($cursos)?>"><?=$d["domicilio"]->_get("label")?></td>
    <td rowspan="<?=count($cursos)?>"><?=$d["sede"]->_get("numero").$d["comision"]->_get("division")."/".$d["planificacion"]->_get("anio","Y").$d["planificacion"]->_get("semestre")?></td>
    <td rowspan="<?=count($cursos)?>"><?=($d["comision"]->_get("apertura"))? "NUEVA" : "HISTORICA" ?></td>
    <td rowspan="<?=count($cursos)?>"><?=$d["plan"]->_get("orientacion")?></td>
    <td rowspan="<?=count($cursos)?>"><?=$d["planificacion"]->_get("anio")."°".$d["planificacion"]->_get("semestre")."C"?></td>
    <td rowspan="<?=count($cursos)?>"><?=$d["comision"]->_get("turno")?></td>
    <td rowspan="<?=count($cursos)?>"></td>
    <?endif;?>
    <td><?=$h["asignatura"]->_get("nombre")?></td>
    <td><?=$h["asignatura"]->_get("codigo")?></td>
    <td><?=$h["curso"]->_get("horas_catedra")?></td>
    
    <?foreach($cursos_horarios[$curso] as $horario):?>
    <td><?=$horario?></td>
    <?endforeach;?>

    
    <?if($first2): $first2 = false; ?>
    <td rowspan="<?=count($cursos)?>"><?=$d["comision"]->_get("identificacion")?></td>
    <?endif;?>
    
    <?if(array_key_exists($curso, $curso_docentes)): $p = $container->getRel("toma")->value($curso_docentes[$curso]);?>
      <td><?=$p["docente"]->_get("nombres", "Xx Yy")?></td>
      <td><?=$p["docente"]->_get("apellidos", "Xx Yy")?></td>
      <td><?=$p["docente"]->_get("cuil")?></td>
      <td><?=$p["docente"]->_get("fecha_nacimiento","d/m/Y")?></td>
    <?else:?>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    <?endif?>
  </tr>
<?endforeach; 
endforeach;?>
</table>

</body>
</html>
