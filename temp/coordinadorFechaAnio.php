<?php

require_once("../config/config.php");

require_once("class/controller/all/CoordinadorFechaAnio.php");

$controller = new CoordinadorFechaAnioAll();
$rows = $controller->main("2019");


//print_r($rows);

//foreach($rows as $row)



//Dba::dbInstance()->multiQueryTransaction($controller->getSql());
//Dba::dbClose();
//echo "<pre>";
//print_r($controller);
?>

<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
    border-collapse: collapse;

}
</style>
<script>
function exportarXls(tableId, nombre = ''){
	nombre = (nombre) ? nombre: 'spreadsheet'
	var uri = 'data:application/vnd.ms-excel;base64,'
	, template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
	, base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
	, format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }

	 var table = document.getElementById(tableId)
	 var ctx = { worksheet: nombre|| 'Worksheet', table: table.innerHTML }

	 var enlaceTmp = document.createElement('a');
	 enlaceTmp.href =  uri + base64(format(template, ctx));
   enlaceTmp.download = nombre+ '.xls';
   enlaceTmp.click();
}
</script>
</head>
<body>

<h2>Coordinadores</h2>
<table>
<tr>
    <th>Apellido y Nombre</th>        
    <th>DNI</th>
    <th>Fecha Nacimiento</th>
</tr>
<? foreach($rows as $row): 
    $p = EntityValues::getInstanceRequire("persona",$row); ?>
    <tr>
        <td><?=$p->apellidos("XX YY")?>, <?=$p->nombres("Xx Yy")?></td>        
        <td><?=$p->numeroDocumento()?></td>
        <td><?=$p->fechaNacimiento("d/m/Y")?></td>
    </tr>
<? endforeach; ?>
</table>
<button class="btn btn-success" onclick="exportarXls('atributoId', 'nombreArchivo')">XLS</button>




<p id="demo"></p>

</body>
</html> 

