<?php

/**
 * Script para definir comisiones
 */
require_once("../config/config.php");
require_once("class/model/Data.php");
require_once("class/model/Values.php");
require_once("class/model/Transaction.php");

require_once("function/array_unique_key.php");
require_once("function/array_combine_keys.php");
require_once("function/array_group_value.php");

$sql = "";

$comision = new ComisionValues();
$comision->setId("201907182");
$comision->setFechaAnio("2019");
$comision->setFechaSemestre(1);
$comision->setObservaciones("Viene del 453");
$comision->setComentario("En espera de confirmación de referente");
$comision->setAutorizada(true);
$comision->setApertura(false);
$comision->setPublicar(true);

$comision->setAnio(1);
$comision->setSemestre(2);
$comision->setDivision(201907173);

$persist = ComisionSqlo::getInstance()->insert($comision->toArray());
$sql .= $persist["sql"];

$comision = new ComisionValues();
$comision->setId("201907183");
$comision->setFechaAnio("2019");
$comision->setFechaSemestre(1);
$comision->setObservaciones("Viene del 453");
$comision->setComentario("En espera de confirmación de referente");
$comision->setAutorizada(true);
$comision->setApertura(false);
$comision->setPublicar(true);

$comision->setAnio(2);
$comision->setSemestre(2);
$comision->setDivision(201907174);

$persist = ComisionSqlo::getInstance()->insert($comision->toArray());
$sql .= $persist["sql"];

$comision = new ComisionValues();
$comision->setId("201907184");
$comision->setFechaAnio("2019");
$comision->setFechaSemestre(1);
$comision->setObservaciones("Viene del 453");
$comision->setComentario("En espera de confirmación de referente");
$comision->setAutorizada(true);
$comision->setApertura(false);
$comision->setPublicar(true);

$comision->setAnio(3);
$comision->setSemestre(2);
$comision->setDivision(201907175);

$persist = ComisionSqlo::getInstance()->insert($comision->toArray());
$sql .= $persist["sql"];

$comision = new ComisionValues();
$comision->setId("201907185");
$comision->setFechaAnio("2019");
$comision->setFechaSemestre(1);
$comision->setObservaciones("Viene del 453");
$comision->setComentario("En espera de confirmación de referente");
$comision->setAutorizada(true);
$comision->setApertura(false);
$comision->setPublicar(true);

$comision->setAnio(2);
$comision->setSemestre(2);
$comision->setDivision(201907178);

$persist = ComisionSqlo::getInstance()->insert($comision->toArray());
$sql .= $persist["sql"];

$comision = new ComisionValues();
$comision->setId("201907185");
$comision->setFechaAnio("2019");
$comision->setFechaSemestre(1);
$comision->setObservaciones("Viene del 453");
$comision->setComentario("En espera de confirmación de referente");
$comision->setAutorizada(true);
$comision->setApertura(false);
$comision->setPublicar(true);

$comision->setAnio(3);
$comision->setSemestre(2);
$comision->setDivision(201907181);

$persist = ComisionSqlo::getInstance()->insert($comision->toArray());
$sql .= $persist["sql"];



echo "<pre>".$sql;