<?php

require_once("../config/config.php"); 
require_once("function/array_group_value.php"); 
require_once("function/array_combine_key2.php"); 

require $_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php';

require_once("class/Container.php");
require_once("class/tools/SpanishDateTime.php");
require_once("function/array_group_value.php");


$container = new Container;

$alumnoTools = $container->getController("alumno_tools");

$alumnoTools->initDni($_GET["numero_documento"]);
$v = $alumnoTools->getValue();

$calificaciones = $alumnoTools->getCalificacionesAprobadas();

$disposiciones = $alumnoTools->getDisposiciones();

$disposicionesRestantes = $alumnoTools->disposicionesRestantes($calificaciones, $disposiciones);
$aniosCursados = $alumnoTools->aniosCursados($disposicionesRestantes);
$aniosRestantes = $alumnoTools->aniosRestantes($aniosCursados);
$mpdf = new \Mpdf\Mpdf();
$html = '
<html>
    <head>
        <style type="text/css">
            body, html {
                margin: 0;
                padding: 0;
            }
            body {
                color: black;
                display: table;
            }
            .container {
                border: 2px solid black;
                width: 750px;
                height: 105mm;
                display: table-cell;
                vertical-align: middle;
            }
            .logo {
                color: black;
                width:350;
                height:100;
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 50%;
                margin-top:10px;
            }
            .marquee {
                color: black;
                font-size: 20px;
                text-align: center;

            }
            .person {
                font-size: 14px;
                font-style: italic;
                width: 500px;
                margin-left: auto;
                margin-right: auto;
                text-align:justify;
            }
            .reason {
                margin: 20px;
            }

            .firma {       
              font-size: 14px; font-style: italic; text-align:right; vertical-align:bottom; margin-right:100px;}
  
            .footer { text-align:right;       margin-top:30mm; margin-right:30px }

            .data {   text-decoration: underline; font-weight:bold; }

        </style>
    </head>
    <body>
        <div class="container">
            <div class="logo">
              <img src="logo.jpg" alt="HTML5 Icon">

            </div>

            <div class="marquee">
                CONSTANCIA DE PASE
            </div>


            <div class="person">
 <p>La Dirección del CENS 462 distrito La Plata, deja constancia que <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("apellidos", "X") . ' ' . $v["persona"]->_get("nombres","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span> DNI <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("numero_documento","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span> ha cursado los años <span class="data">&nbsp;&nbsp;&nbsp;' . implode(", ", $aniosCursados) . '&nbsp;&nbsp;&nbsp;</span> del Programa Fines 2 Trayecto Secundario orientación <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("orientacion") . '&nbsp;&nbsp;&nbsp;</span> resolución <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("resolucion") . '&nbsp;&nbsp;&nbsp;</span>, adeudando las siguientes materias:</p>
            <ul>
 ';

foreach($disposicionesRestantes as $d){
  if(key_exists($d["pla_anio"], $aniosRestantes)) continue; 
  $html .= "<li>".$d["asi_nombre"] . " (" . $d["pla_anio"]."º año)</li>";
}

foreach($aniosRestantes as $a){
  $html .= "<li>Todas las asignaturas de ". $a . "</li>";
}

$date = new SpanishDateTime();

$html .='</ul>
  <p>Se extiende la presente a pedido del interesado en La Plata el día <span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("d") . ' de ' . $date->format("M") . ' de ' . $date->format("Y"). '&nbsp;&nbsp;&nbsp;</span> para ser presentado ante <span class="data">&nbsp;&nbsp;&nbsp;quien corresponda&nbsp;&nbsp;&nbsp;</span>.</p>
</div>
<div class="footer">
  <img src="sello_cens.png"  width="125" height="160">
  <img src="firma_director.png"  width="250" height="150">
</div>

<div class="firma">
  <p>Firma Autoridad</p>
</div>

</div>
        
</body>
</html>
';


$mpdf = new \Mpdf\Mpdf();
$mpdf->SetProtection(["print"]);

$mpdf->WriteHTML($html);
$mpdf->Output("constancia.pdf", 'I');
