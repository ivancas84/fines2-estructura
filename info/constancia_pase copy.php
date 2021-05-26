<?php

require_once("../config/config.php"); 
require_once("function/array_group_value.php"); 
require_once("function/array_combine_key2.php"); 

require $_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php';

require_once("class/Container.php");
require_once("class/tools/SpanishDateTime.php");

$container = new Container;
$render = $container->getRender("alumno");
$render->setCondition(["per-numero_documento","=","41325864"]);
$row = $container->getDb()->one("alumno",$render);
$v = $container->getRel("alumno")->value($row);

$render = $container->getRender("calificacion");
$render->setCondition([
  ["persona","=",$v["persona"]->_get("id")],
  [
    ["nota_final",">=","7"],
    ["crec",">=","4","OR"],
  ]
]);
$render->setOrder(["pla-anio"=>"asc","pla-semestre"=>"asc","asi-nombre"=>"asc"]);
$calificaciones  = $container->getDb()->all("calificacion",$render);

$plan = $calificaciones[0]["pla_plan"];
$orientacion = $calificaciones[0]["pla_plb_orientacion"];
$resolucion = $calificaciones[0]["pla_plb_resolucion"];


$anio_ingreso = (empty($v["alumno"]->_get("anio_ingreso"))) ? 1 : $v["alumno"]->_get("anio_ingreso"); 
$render = $container->getRender("distribucion_horaria");
$render->setCondition([
  ["pla-plan","=",$plan],
  ["pla-anio",">=",$anio_ingreso]
]);
$render->setOrder(["pla-anio"=>"asc","pla-semestre"=>"asc", "asi-nombre"=>"asc"]);
$render->setFields(["asignatura", "asi-nombre", "planificacion", "pla-anio"]);


$disposicion =  array_combine_key2(
  $container->getDb()->select("distribucion_horaria",$render),
  ["asignatura","planificacion"]
);

$ids_c = array_keys(
  array_combine_key2($calificaciones, ["asignatura", "planificacion"])
);
$ids_d = array_keys($disposicion);
$ids_r = array_diff($ids_d, $ids_c);

$disposicion_resultante_ = array_intersect_key($disposicion, array_flip($ids_r) );
echo "<pre>";

print_r($disposicion_resultante_);

$anios = [];
foreach($disposicion_resultante_ as $dr){
  if(!key_exists($dr["pla_anio"], $anios)) {
    $anios[$dr["pla_anio"]] = 1;
  }
  else {
    $anios[$dr["pla_anio"]]++;
  }
}



$anios_cursados = [];
for($i = $anio_ingreso; $i <= 3; $i++) {
  if(!key_exists($i, $anios) ||  $anios[$i] < 5) {
    switch($i){
      case 1: array_push($anios_cursados, "Primero"); break;
      case 2: array_push($anios_cursados, "Segundo"); break;
      case 3: array_push($anios_cursados, "Tercero"); break;
    }
  }
}


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
 <p>La Dirección del CENS 462 distrito La Plata, deja constancia que <strong>' . $v["persona"]->_get("apellidos", "X") . ' ' . $v["persona"]->_get("nombres","Xx Yy") . '</strong> ha cursado los años <strong>' . implode(", ", $anios_cursados) . '</strong> del Programa Fines 2 Trayecto Secundario orientación <strong>' . $orientacion. '</strong> resolución <strong>' . $resolucion . '</strong>, adeudando las siguientes materias:</p>
            <ul>
 ';

foreach($disposicion_resultante_ as $d){
  $html .= "<li>".$d["asi_nombre"] . " (" . $d["pla_anio"]."º año)</li>";
}


$date = new SpanishDateTime();

$html .='</ul>
  <p>Se extiende la presente en La Plata a pedido del interesado el día ' . $date->format("d") . ' de ' . $date->format("M") . ' de ' . $date->format("Y"). ' para ser presentado ante quien corresponda.</p>
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
