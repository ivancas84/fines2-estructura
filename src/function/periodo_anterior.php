<?php


function periodo_anterior($anio, $semestre){
  if(empty($anio) || empty($semestre)) throw new Exception("Los parametros estan vacios");
  
  $anio = intval($anio);
  $semestre = intval($semestre);

  if(($semestre != 1 && $semestre != 2) || ($anio != 1 && $anio != 2 && $anio != 3)) throw new Exception("Los parametros son incorrectos ANIO: " . $anio . " SEMESTRE: " . $semestre);
  if($semestre == 2) return ["anio" => $anio, "semestre" => 1];
  
  if($anio == 1) throw new Exception("El periodo 1/1 no tiene anterior");
  return ["anio"=> ($anio-1), "semestre"=>2];

}


function periodo_anterior2(array $tramo, $prefix=""){
  return periodo_anterior($tramo[$prefix."anio"],$tramo[$prefix."semestre"]);
}