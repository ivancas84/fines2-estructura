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

$mpdf->Image('firma_director.png', 33, 190, 42, 42, 'png', '', true, false);
$mpdf->Image('sello_cens.png', 148, 190, 32, 43, 'png', '', true, false);

$mpdf->AddPage(); 

$tplId = $mpdf->importPage(2);

$actualsize = $mpdf->useTemplate($tplId);

// The height of the template as it was printed is returned as $actualsize['h']
// The width of the template as it was printed is returned as $actualsize['w']


$mpdf->Output();