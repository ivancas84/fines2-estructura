<?php

require_once("../config/config.php"); 
require $_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php';

require_once("class/Container.php");

$container = new Container;
$render = $container->getControllerEntity("render_build", "persona")->main();
$render->setCondition(["numero_documento","=",$_GET["dni"]]);
$row = $container->getDb()->one("persona",$render);
$v = $container->getValue("persona")->_fromArray($row,"set");

$mpdf = new \Mpdf\Mpdf();

// Add First page
$mpdf->AddPage();

$pagecount = $mpdf->setSourceFile('progresar.pdf');
$tplId = $mpdf->importPage(1);
$actualsize = $mpdf->useTemplate($tplId);
$mpdf->SetXY(19,47);
$mpdf->Cell(62,6,implode("   ", str_split ($v->_get("cuil"))));
$mpdf->SetXY(138,47);

$mpdf->Cell(62,6,implode("   ", str_split ("DNI ".$v->_get("numero_documento"))));

$mpdf->SetXY(58,54);
$mpdf->Cell(0,6,$v->_get("apellidos","XX YY") . " " . $v->_get("nombres","Xx Yy"));


//DATOS DE EDUCACION
$mpdf->SetXY(64,142);
$mpdf->Cell(0,6,"X");

$mpdf->SetXY(74,149);
$mpdf->Cell(0,6,"CENS 462");

$mpdf->SetXY(48,155);
$mpdf->Cell(0,6,"0  6   0  8   8  3   8  0   0");

$mpdf->SetXY(160,155);
$mpdf->Cell(0,6,"19/04/2021");

// opcion inscripto
// $mpdf->SetXY(171,166);
// $mpdf->Cell(0,6,"X");

// opcion cursando
$mpdf->SetXY(200,166);
$mpdf->Cell(0,6,"X");

// opcion plan fines o adultos 2000
$mpdf->SetXY(49,184);
$mpdf->Cell(0,6,"X");

// opcion cantidad de materias al iniciar
$mpdf->SetXY(155,184);
$mpdf->Cell(0,6,"0");


// opcion cantidad de materias restantes
$mpdf->SetXY(155,191);
$mpdf->Cell(0,6,"30");


$mpdf->Image('firma_director.png', 20, 190, 80  , 42, 'png', '', true, false);
$mpdf->Image('sello_cens.png', 154, 190, 33, 45, 'png', '', true, false);

$mpdf->AddPage(); 

$tplId = $mpdf->importPage(2);

$actualsize = $mpdf->useTemplate($tplId);

// The height of the template as it was printed is returned as $actualsize['h']
// The width of the template as it was printed is returned as $actualsize['w']


$mpdf->Output();