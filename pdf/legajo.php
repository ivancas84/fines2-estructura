<?php

require_once("../config/config.php"); 
require_once("function/array_group_value.php"); 
require_once("function/array_combine_key2.php"); 

require $_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php';

require_once("class/Container.php");
require_once("class/tools/SpanishDateTime.php");
require_once("function/array_group_value.php");
require_once("function/settypebool.php");
require_once("function/qr.php");
require_once("function/pdf/indexSimple.php");
require_once("function/pdf/header.php");
require_once("function/pdf/signature.php");
require_once("function/pdf/index.php");

function getCalificaciones($idAlumno){
  global $container;
  $render = $container->getRender("calificacion");
  $render->setCondition([
    ["alumno","=",$idAlumno],
  ]);
  $render->setOrder(["dis_pla-anio"=>"asc","dis_pla-semestre"=>"asc","dis_asi-nombre"=>"asc"]);
  return $container->getDb()->all("calificacion",$render);
}


// Source: http://stackoverflow.com/questions/5943368/dynamically-generating-a-qr-code-with-php
// Google Charts Documentation: https://developers.google.com/chart/infographics/docs/qr_codes?csw=1#overview


$qrcode = qr($_GET["url"]);

$container = new Container;

$alumnoTools = $container->getController("alumno_tools");

$alumnoTools->init($_GET["id"]);
$v = $alumnoTools->getValue();
$calificaciones = getCalificaciones($_GET["id"]);


$disposiciones = $alumnoTools->getDisposiciones();

$disposicionesRestantes = $alumnoTools->disposicionesRestantes($calificaciones, $disposiciones);

$anios = $alumnoTools->aniosCursados($disposicionesRestantes);
$anioActual = $alumnoTools->anioActual2($anios);
$date = new SpanishDateTime();
$mpdf = new \Mpdf\Mpdf();

$c = '

<div class="content">
  <p>Nombre: <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("apellidos", "X") . ', ' . $v["persona"]->_get("nombres","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span>,
 DNI Nº <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("numero_documento","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span>,
fecha de nacimiento <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("fecha_nacimiento","d") . ' de ' . $v["persona"]->_get("fecha_nacimiento","F") . ' de ' . $v["persona"]->_get("fecha_nacimiento","Y") . '&nbsp;&nbsp;&nbsp;</span>,
lugar de nacimiento <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("lugar_nacimiento", "Xx Yy") . '&nbsp;&nbsp;&nbsp;</span>, 
modalidad <span class="data">&nbsp;&nbsp;&nbsp; Programa Fines 2 Trayecto Secundario&nbsp;&nbsp;&nbsp;</span>,
orientación <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("orientacion") . '&nbsp;&nbsp;&nbsp;</span>, 
resolución <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("resolucion") . '&nbsp;&nbsp;&nbsp;</span>
  </p>
  <ul>
';

// echo "<pre>";
// print_r($calificaciones);
//die();
foreach($calificaciones as $cal){
  $ca = $container->getRel("calificacion")->value($cal);
  $c .= "<li>".$ca["asignatura"]->_get("nombre") . "</li>";
}

$c.='
</ul>
</div>
';
$html = htmlToPdfIndex($c); 


// echo $html;
$mpdf = new \Mpdf\Mpdf();
$mpdf->SetProtection(["print"]);

$mpdf->WriteHTML($html);
$mpdf->Output("constancia.pdf", 'I');
