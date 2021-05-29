<?php

require_once("../config/config.php"); 
require_once("function/array_group_value.php"); 
require_once("function/array_combine_key2.php"); 

require $_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php';

require_once("class/Container.php");
require_once("class/tools/SpanishDateTime.php");
require_once("function/array_group_value.php");
require_once("function/settypebool.php");

$container = new Container;

$alumnoTools = $container->getController("alumno_tools");

$alumnoTools->initDni($_GET["numero_documento"]);
$v = $alumnoTools->getValue();

$calificaciones = $alumnoTools->getCalificacionesAprobadas();

$disposiciones = $alumnoTools->getDisposiciones();

$disposicionesRestantes = $alumnoTools->disposicionesRestantes($calificaciones, $disposiciones);
$anios = $alumnoTools->aniosCursados($disposicionesRestantes);
$aniosCursados = $alumnoTools->traducirAniosAux($anios);
$date = new SpanishDateTime();
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
                CONSTANCIA DE CERTIFICADO DE ESTUDIO EN TRÁMITE
            </div>


            <div class="person">
 <p>La Dirección de la Escuela de Educación CENS Nº 462 de La Plata, 
hace constar por la presente que <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("apellidos", "X") . ' ' . $v["persona"]->_get("nombres","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span> DNI Nº <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("numero_documento","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span>
tiene en trámite un CERTIFICADO ANALÍTICO DE ESTUDIOS <span class="data">&nbsp;&nbsp;&nbsp;COMPLETO&nbsp;&nbsp;&nbsp;</span>
de <span class="data">&nbsp;&nbsp;&nbsp;' . end($aniosCursados) . '&nbsp;&nbsp;&nbsp;</span> año <span class="data">&nbsp;&nbsp;&nbsp;Programa Fines 2 Trayecto Secundario&nbsp;&nbsp;&nbsp;</span>
con orientación en <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("orientacion") . '&nbsp;&nbsp;&nbsp;</span> resolución <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("resolucion") . '&nbsp;&nbsp;&nbsp;</span>, adeudando: <span class="data">&nbsp;&nbsp;&nbsp;Ninguna materia&nbsp;&nbsp;&nbsp;</span>
</p>
<p>A pedido del/de la interesado/a y al sólo efecto de ser presentado ante las autoridades que se lo exijan, se extiene la presente en La Plata a los <span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("d") . '&nbsp;&nbsp;&nbsp;</span>
del mes de <span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("M") . '&nbsp;&nbsp;&nbsp;</span> 
de <span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("Y") . '&nbsp;&nbsp;&nbsp;</span>.
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
