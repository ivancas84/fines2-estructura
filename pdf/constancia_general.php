<?php

require_once("../config/config.php"); 
require $_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php';

require_once("class/Container.php");

$container = new Container;
$render = $container->getRender("persona");
$render->setCondition(["numero_documento","=","31073351"]);
$row = $container->getDb()->one("persona",$render);
$v = $container->getValue("persona")->_fromArray($row,"set");

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
        </style>
    </head>
    <body>
        <div class="container">
            <div class="logo">
              <img src="logo.jpg" alt="HTML5 Icon">

            </div>

            <div class="marquee">
                CONSTANCIA DE ALUMNO REGULAR
            </div>


            <div class="person">
 <p>Escuela Nº CENS 462 Distrito La Plata. Fecha 10-10-1010.</p>
 <p>La Dirección del Establecimiento, deja constancia que Juan Perez DNI 31088333 es alumno regular de primer año.</p>
 <p>Se extiende el pedido del interesado para ser presentado ante quien corresponda</p> 
            </div>
        </div>
    </body>
</html>


';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output();
