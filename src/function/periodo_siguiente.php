<?php


function periodo_siguiente($anio, $semestre){
    if(empty($anio) || empty($semestre)) throw new Exception("Los parametros estan vacios");
    
    $anio = intval($anio);
    $semestre = intval($semestre);

    if(($semestre != 1 && $semestre != 2)) throw new Exception("Los parametros son incorrectos ANIO: " . $anio . " SEMESTRE: " . $semestre);
    if($semestre == 2) return ["anio" => $anio+1, "semestre" => 1];
    return ["anio"=> $anio, "semestre"=>1];
}