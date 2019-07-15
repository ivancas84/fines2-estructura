<?php

require_once("./config.php");
require_once("config/modelClasses.php");
require_once("config/entityClasses.php");
require_once("config/valuesClasses.php");
require_once("class/model/Dba.php");

$nuevaFecha = "2019-03-01";

$dba = new Dba();
$rows = $dba->all("comision", [["fecha", "=", "2018-07-01"], ["autorizada","=",true], ["dvi_plan", "!=", 3]]);


echo "cantidad de comisiones existentes " . count($rows);


$creadas = 0;
$update = "";
foreach($rows as $row) {
  $comision = new ComisionValues($row);
  $division = new DivisionValues($row["division_"]);
  $anio = $row["anio"];
  $semestre = $row["semestre"];
  $serie = $division->serie();
  $numero_division = $division->numero();
  //$sede = $row["sed_numero"];


  echo "<br>";
  echo "<br>";
  echo "Comision existente: " . $numero_division . $anio . $semestre . " (" . $comision->id() . ")<br>";

  if(($semestre != 1 && $semestre != 2) || ($anio != 1 && $anio != 2 && $anio != 3)) {
     echo "<b>Anio o semestre invalido, no se agregara nueva comision</b><br>";
     continue;
  }

  if(($semestre == 2) && ($anio == 3)) {
    echo "<b>Anio 3 y semestre 2, no se agregara nueva comision</b><br>";
    continue;
  }

  if($semestre == 1) {
    $newAnio = $anio;
    $newSemestre = 2;
  } else {
    $newAnio = $anio + 1;
    $newSemestre = 1;
  }



  $newNumero = $numero_division . $newAnio . $newSemestre;
  echo "Nueva comision: " . $newNumero . "<br>";
  $rowsByNumero = $dba->all("comision", [["dvi_numero", "=", $numero_division], ["anio", "=", $newAnio], ["semestre", "=", $newSemestre]]);


  if(count($rowsByNumero)) {
    echo "<b>Se deberia crear la comision " . $newNumero . " pero ya existe </b><br>";
    continue;
  }

  echo "Se creara la comision " . $newNumero . "<br>";


  $datos = array(
    "numero" => $newNumero,
    "anio" => $newAnio,
    "semestre" => $newSemestre,
    "division" => $division->id(),
    "fecha" => $nuevaFecha,
  );

  try{
    $creadas++;
    //$persist = $comisionDao->persistSql($datos);
    //$db->multiQueryTransaction($persist["sql"]);
    $comisionSqlo = new ComisionSqlo();
    $persist = $comisionSqlo->insert($datos);
    $persist["sql"] .= "UPDATE comision SET comision_siguiente = " . $persist["id"] . " WHERE id = " . $row["id"] . ";
";
    $db = $dba::dbInstance();
    //echo $persist["sql"];
    //$db->multiQueryTransaction($persist["sql"]);

    //print_r($datos);
  } catch (Exception $exception){
    echo "<b>Error al crear comision  " . $newNumero . ": " . $exception;
  }
  echo "<br><br>";

}



 // echo "Se han creado" .     $creadas++;
  //echo "<br>";
  //echo $update;
