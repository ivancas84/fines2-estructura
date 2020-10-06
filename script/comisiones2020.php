<?php

require_once("../config/config.php");
require_once("class/tools/Filter.php");
require_once("class/Container.php");

$container = new Container();
$render = new Render();
$render->setCondition([
  ["cal_anio","=","2020"],
  ["cal_semestre","=","2"],
  ["moa_nombre","=","Fines 2"],
  ["autorizada","=",true],
  //["identificacion","=",false]
]);
$render->setOrder(["sed_numero"=>"ASC"]);

$rows = $container->getDb()->all("comision",$render);

$s = $container->getSqlo("comision");
?>

<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>
<table>
  
  <?$i=0; foreach($rows as $row): $v = $s->values($row); $i++?>
  <tr>
    <td><?=$i?>)&nbsp;</td>
    <td><?=$v["sede"]->numero()?></td>
    <td><?=$v["comision"]->division()?></td>
    <td><?=$v["planificacion"]->anio()?><?=$v["planificacion"]->semestre()?></td>  
  </tr>
  <?endforeach;?>
</table>
</body>
</html>

