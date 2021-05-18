<?php

require_once("../config/config.php"); 
require_once("function/array_group_value.php"); 

require $_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php';

require_once("class/Container.php");
require_once("class/tools/SpanishDateTime.php");

$container = new Container;
$render = $container->getRender("persona");
$render->setCondition(["numero_documento","=","41325864"]);
$row = $container->getDb()->one("persona",$render);
$v = $container->getValue("persona")->_fromArray($row,"set");



$render = $container->getRender("calificacion");
$render->setCondition([
  ["persona","=",$v->_get("id")],
  [
    ["nota_final",">=","7"],
    ["crec",">=","4","OR"],
  ]
]);
$render->setOrder(["pla-anio"=>"asc","pla-semestre"=>"asc","asi-nombre"=>"asc"]);
$calificaciones  = $container->getDb()->all("calificacion",$render);

$planificacion = $calificaciones[0]["planificacion"];

//$orientacion = $calificaciones[0]["pla_plb_orientacion"];
//$resolucion = $calificaciones[0]["pla_plb_resolucion"];




$calificaciones = array_group_value($calificaciones, "pla_anio");
$mpdf = new \Mpdf\Mpdf();
$html = '
<html>
    <head>
        <style type="text/css">
            body, html {color: black; margin: 0; padding: 0; }
            .container {
                border: 2px solid black;
                width: 200mm;
                height: 270mm;
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

            .asignaturas {
              width: 95%;
              margin-left: auto;
              margin-right: auto;

            }

            
            .asignaturas table {
              font-size: 14px;
              border-collapse:collapse;
            }

            .asignaturas th{
              border: 1px solid black;
          }

            .asignaturas td{
                width: 33%;
                text-align: left;
                border: 1px solid black;
            }

          .firma {       
            font-size: 14px; font-style: italic; text-align:right; vertical-align:bottom; margin-right:100px;}

          .footer { 
            
     text-align:right;       margin-top:30mm; margin-right:30px
  }


  .footer img {
  }
          
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
 <p>La Dirección del CENS 462 Distrito La Plata, deja constancia que <strong>' . $v->_get("apellidos","X") . ', ' . $v->_get("nombres", "Xx Yy") . ' DNI ' .  $v->_get("numero_documento") . '</strong> tiene aprobadas las siguientes asignaturas correspondientes al Programa Fines 2 Trayecto Secundario orientación ' . $orientacion. ' resolución ' . $resolucion . ' </p>
</div>

<div class="asignaturas">
 <table>

<tr>
 ';

 foreach($calificaciones as $anio => $calif){
   $html .= "
  <th>AÑO " . $anio . "</th>
";
 }

 $html .= "</tr><tr>";

foreach($calificaciones as $anio => $calif){
  $html .= "<td>
  
  <ul>
  ";
   

  foreach($calif as $ca){
    $c = $container->getRel("calificacion")->value($ca);
    $nota = (intval($c["calificacion"]->_get("nota_final")) >= 7) ? $c["calificacion"]->_get("nota_final") : $c["calificacion"]->_get("crec") . " crec";
  
    $html .= "<li>" . $c["asignatura"]->_get("nombre") . ": <strong>" . $nota . "</strong></li>";
  }
  
  $html .= "</ul></td>";
}


  $date = new SpanishDateTime();

  $html .='</tr></table>
  </div>



  <div class="person">

    <p>Se extiende la presente a pedido del interesado el día ' . $date->format("d") . ' de ' . $date->format("M") . ' de ' . $date->format("Y"). ' para ser presentado ante quien corresponda</p>

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
