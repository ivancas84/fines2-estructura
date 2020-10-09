<?php

require_once("../config/config.php");
require_once("class/tools/Filter.php");
require_once("class/Container.php");

$container = new Container();
$render = new Render();
$render->setCondition([
  ["cur_com_cal_anio","=","2020"],
  ["cur_com_cal_semestre","=","2"],
  ["cur_com_moa_nombre","=","Fines 2"],
  ["estado","=","Aprobada"]
]);
$render->setOrder(
  ["doc_numero_documento"=>"ASC"]
);

$rows = $container->getDb()->all("toma",$render);

$s = $container->getSqlo("toma");
?>

<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>
<table>
  <?foreach($rows as $row): $v = $s->values($row);?>
  <tr>
    <td>S/C</td>
    <td><?=$v["docente"]->preCuil()?></td>
    <td><?=$v["docente"]->numeroDocumento()?></td>
    <td><?=$v["docente"]->suCuil()?></td>
    <td></td>
    <td><?=$v["docente"]->fechaNacimiento("d/m/Y")?></td>
    <td><?=$v["docente"]->apellidos("X") . ", " . $v["docente"]->nombres("Xx Yy") ?></td>
    <td>P</td>
    <td><?=$v["plan"]->acronimoOrientacion("X") ?></td>
    <td><?=$v["asignatura"]->codigo() ?></td>
    <td><?=$v["curso"]->horasCatedra() ?></td>
    <td>PF</td>
    <td><?=$v["planificacion"]->anio() ?></td>
    <td><?=$v["planificacion"]->semestre() ?></td>
    <td><?=$v["comision"]->turno() ?></td>
    <td><?=$v["toma"]->tipoMovimiento() ?></td>

    <td><?=$v["toma"]->fechaToma("d") ?></td>
    <td><?=$v["toma"]->fechaToma("m") ?></td>
    <td><?=$v["toma"]->fechaToma("Y") ?></td>
    <td><?=$v["calendario"]->fin("d") ?></td>
    <td><?=$v["calendario"]->fin("m") ?></td>
    <td><?=$v["calendario"]->fin("Y") ?></td>

  
  </tr>
  <?endforeach;?>
</table>
</body>
</html>
