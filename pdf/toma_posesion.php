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
//$toma = "609dae4ce9b7d";

$mt = $container->getController("model_tools");
$toma = $container->getDb()->get("toma",$_GET["toma"]);
$curso = $mt->labelCurso($toma,"cur_");

$horario_ = $container->getController("model_tools")->cursoHorario([$toma["curso"]]);
$horario = count($horario_) ? $horario_[0]["horario"] : null;

$t = $container->tools("toma")->value($toma);

$fechaToma = $t["toma"]->_get("fecha_toma");
$fechaFin = clone $fechaToma;
$fechaFin->modify("+ 4 month");

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
            }
            .container {
              position:relative;
                width: 750px;
                height: 105mm;
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
                margin-top:20px;
                margin-left: auto;
                margin-right: auto;
                text-align:justify;
            }
            .reason {
                margin: 20px;
            }

            .firma {       
              top:10px;;
              left:50px;
              font-size: 14px; font-style: italic;  vertical-align:bottom;
              text-align:center; 
            }
  
            .footer { text-align:right; margin-top:30mm; margin-right:30px }

            .data {   text-decoration: underline; font-weight:bold; }


        </style>
    </head>
    <body>
        <div class="container">

            <div class="marquee">
                Fines Trayecto Secundario
            </div>

            <div class="marquee">
              ACTA DE TOMA DE POSESIÓN INDIVIDUAL
            </div>
            

            <div class="person">

              <p>En La Plata, a los <span class="data">&nbsp;&nbsp;&nbsp;' . $fechaToma->format("d") . '&nbsp;&nbsp;&nbsp;</span> días del mes de <span class="data">&nbsp;&nbsp;&nbsp;' . $fechaToma->format("F") . '&nbsp;&nbsp;&nbsp;</span> de <span class="data">&nbsp;&nbsp;&nbsp;' . $fechaToma->format("Y") . '&nbsp;&nbsp;&nbsp;</span>, 
              se procede a dar toma de posesión al/la docente: <span class="data">&nbsp;&nbsp;&nbsp;' . $t["docente"]->_get("apellidos", "XX YY")  . ' ' . $t["docente"]->_get("nombres", "Xx Yy")  . '&nbsp;&nbsp;&nbsp;</span> DNI <span class="data">&nbsp;&nbsp;&nbsp;' . $t["docente"]->_get("numero_documento")  . '&nbsp;&nbsp;&nbsp;</span>.</p>
              <p>Que se desempeñará en las asignaturas correspondientes al <strong>PLAN DE ESTUDIOS R6321/95-R713/17, del plan FinEs 2 de Terminalidad de Nivel Secundario</strong>, dependiente de la Dirección de Educación de Adultos según el siguiente detalle:</p>
            
              <div style="clear:both;display:block;margin:0 0 10px 0;padding:10px 0 10px 0;border-top:1px solid #d7d7d7">
            <table>
        <tbody>
          <tr>
            <td><strong>CENS Nº:</strong></td>
           <td>462</td>
          </tr>
          <tr>
            <td><strong>Sede:</strong></td>
            <td>' . $t["sede"]->_get("nombre") . ' (' . $t["sede"]->_get("numero") . ')</td>
          </tr>
          <tr>
            <td><strong>Comisión:</strong></td>
            <td>' . $t["sede"]->_get("numero") . $t["comision"]->_get("division") . '/' . $t["planificacion"]->_get("anio") . $t["planificacion"]->_get("semestre") . '</td>
          </tr>
          <tr>
            <td width="148"><strong>Fecha de toma:</strong></td>
            <td width="400">' . $t["toma"]->_get("fecha_toma","d/m/Y") . '</td>
          </tr>
          <tr>
            <td width="148"><strong>Fecha de finalización:</strong></td>
            <td width="400">' . $fechaFin->format("d/m/Y") . '</td>
          </tr>
          <tr>
            <td><strong>Asignatura:</strong></td>
            <td>' . $t["asignatura"]->_get("nombre") . '</td>
          </tr>
          <tr>
            <td><strong>Horario:</strong></td>
            <td>' . $horario . '</td>
          </tr>
          <tr>
            <td><strong>Horas Cátedra:</strong></td>
            <td>' . $t["curso"]->_get("horas_catedra") . '</td>
          </tr>
          
        </tbody>
        </table>
      </div>
      <div style="clear:both;display:block;margin:0 0 10px 0;padding:10px 0 10px 0;border-top:1px solid #d7d7d7">
        <p>El/la docente asume el compromiso de: participar en las mesas examinadoras a las que fuera convocado, colaborar con el referente de la sede y entregar una copia impresa de las planillas solicitadas al finalizar el cuatrimestre al CENS al cual corresponde la comisión y sede. Declara no estar en uso de licencia, cambio de funciones o superposición horaria).</p>
      </div>    

</div>
<div class="footer">
  <img src="sello_cens.png"  width="125" height="160">
  <img src="firma_director.png"  width="250" height="150">
</div>

<div class="firma">
  <span>Firma Docente</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Firma Autoridad</span>
</div>



</div>
        
</body>
</html>
';


$mpdf = new \Mpdf\Mpdf();
$mpdf->SetProtection(["print"]);

$mpdf->WriteHTML($html);
$mpdf->Output("toma.pdf", 'I');
