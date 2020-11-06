<?php

require_once("../config/config.php");
require_once("class/model/Render.php");
require_once("class/Container.php");
require_once("function/acronym.php");

$container = new Container();
$render = new Render();
$render->setSize(0);
$render->setCondition([
  ["tom_cur_com_cal-anio","=","2020"],
  ["tom_cur_com_cal-semestre","=","2"],
  ["tom_cur_com_moa-nombre","=","Fines 2"],
  //["tom_estado","=",["Aprobada","Renuncia"]],
  //["tom_estado_contralor","=","Pasar"],
]);
$rows = $container->getDb()->all("asignacion_planilla_docente",$render);

$id_tomas = array_column($rows, "toma");


$render = new Render();
$render->setSize(0);
$render->setCondition([
  ["cur_com_cal-anio","=","2020"],
  ["cur_com_cal-semestre","=","2"],
  ["cur_com_moa-nombre","=","Fines 2"],
  ["estado","=","Aprobada"],
  ["id","!=",$id_tomas],
]);
$render->setOrder([
  "doc-numero_documento"=>"ASC"
]);

$rows = $container->getDb()->all("toma",$render);
/*foreach($rows as $row) {
  
  echo "<br>INSERT INTO asignacion_planilla_docente(id, toma, planilla_docente) VALUES ('".uniqid()."', '".$row["id"]."','1');";
}*/

?>

<table>
  <?foreach($rows as $row):?>
    <?$r = $container->getRel("toma")->value($row);?>
    <?$t = (acronym($r["comision"]->_get("turno"))=="N") ? "V":acronym($r["comision"]->_get("turno"));?>
    <tr>
      <td>S/N</td>
      <td><?=substr($r["docente"]->_get("cuil"),0,2)?></td>
      <td><?=$r["docente"]->_get("numero_documento")?></td>
      <td><?=substr($r["docente"]->_get("cuil"),-1,1)?></td>
      <td></td>
      <td><?=$r["docente"]->_get("fecha_nacimiento","d/m/Y")?></td>
      <td><?=$r["docente"]->_get("apellidos","XX YY")?>, <?=$r["docente"]->_get("nombres","Xx Yy")?></td>
      <td>P</td>
      <td><?=acronym($r["plan"]->_get("orientacion"))?></td>
      <td><?=$r["asignatura"]->_get("codigo")?></td>
      <td><?=$r["curso"]->_get("horas_catedra")?></td>
      <td>PF</td>
      <td><?=$r["planificacion"]->_get("anio")?></td>
      <td><?=$r["planificacion"]->_get("semestre")?></td>
      <td><?=$t?></td>
      <td>AI</td>
      <td><?=$r["toma"]->_get("fecha_toma","d")?></td>
      <td><?=$r["toma"]->_get("fecha_toma","m")?></td>
      <td><?=$r["toma"]->_get("fecha_toma","y")?></td>
      <td>31</td>
      <td>12</td>
      <td>20</td>
      <td><?=$r["toma"]->_get("comentario")?></td>

    </tr>
  <?endforeach;?>
</table>



  
