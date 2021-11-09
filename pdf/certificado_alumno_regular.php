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
require_once("function/pdf/index.php");
require_once("function/pdf/header.php");
require_once("function/pdf/signature.php");




// Source: http://stackoverflow.com/questions/5943368/dynamically-generating-a-qr-code-with-php
// Google Charts Documentation: https://developers.google.com/chart/infographics/docs/qr_codes?csw=1#overview


$qrcode = qr($_GET["url"]);

$container = new Container;

$alumnoTools = $container->getController("alumno_tools");

$alumnoTools->init($_GET["id"]);
$v = $alumnoTools->getValue();

$calificaciones = $alumnoTools->getCalificacionesAprobadas();
$disposiciones = $alumnoTools->getDisposiciones();

$disposicionesRestantes = $alumnoTools->disposicionesRestantes($calificaciones, $disposiciones);

$anios = $alumnoTools->aniosCursados($disposicionesRestantes);
$anioActual = $alumnoTools->anioActual2($anios);
$date = new SpanishDateTime();
$mpdf = new \Mpdf\Mpdf();

$c = htmlToPdfHeader($qrcode);
$c .= '
<div class="title">
  CONSTANCIA DE ALUMNO REGULAR
</div>
<div class="content">
  <p>La Dirección de la Escuela de Educación CENS Nº 462 de La Plata, 
hace constar por la presente que <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("apellidos", "X") . ' ' . $v["persona"]->_get("nombres","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span> DNI Nº <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("numero_documento","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span>
es alumna regular de <span class="data">&nbsp;&nbsp;&nbsp;' . $anioActual . '&nbsp;&nbsp;&nbsp;</span> año <span class="data">&nbsp;&nbsp;&nbsp;Programa Fines 2 Trayecto Secundario&nbsp;&nbsp;&nbsp;</span>
con orientación en <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("orientacion") . '&nbsp;&nbsp;&nbsp;</span> resolución <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("resolucion") . '&nbsp;&nbsp;&nbsp;</span>
  </p>
  <p>A pedido del/de la interesado/a y al sólo efecto de ser presentado ante las autoridades que se lo exijan, se extiene la presente en La Plata a los <span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("d") . '&nbsp;&nbsp;&nbsp;</span> días
del mes de <span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("F") . '&nbsp;&nbsp;&nbsp;</span> 
de <span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("Y") . '&nbsp;&nbsp;&nbsp;</span>.
  </p>
</div>
';
$c .= htmlToPdfSignature();
$html = htmlToPdfIndex($c); 


// echo $html;
$mpdf = new \Mpdf\Mpdf();
$mpdf->SetProtection(["print"]);

$mpdf->WriteHTML($html);
$mpdf->Output("constancia.pdf", 'I');
