<?php


class DistribucionHorariaCargasHorariasAsignatura  {

    /**
     * Suma de horas catedra por asignatura de un conjunto de distribuciones
     * horarias.
     * La suma de horas catedra por asignatura se conoce como "carga horaria"
     * La consulta de distribuciones_horarias debe incluir los atributos:ç
     *     "asignatura-id"
     *     "horas_catedra"
     */
    public function main(array $distribuciones_horarias){
        $cha = [];
        
        foreach($distribuciones_horarias as $dh){
            if(!array_key_exists($dh["asignatura-id"], $cha)) $cha[$dh["asignatura-id"]] = 0;
            $cha[$dh["asignatura-id"]] += intval($dh["horas_catedra"]);
          }
      
          return $cha;
    }
}