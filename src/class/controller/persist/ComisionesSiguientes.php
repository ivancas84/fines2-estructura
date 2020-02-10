<?php


require_once("class/controller/Persist.php");
require_once("class/model/Ma.php");


class ComisionesSiguientesPersist extends Persist {
  /**
   * Persistencia de cursos y comisiones
   */

  public function main($data){
    /**
     * @param $data["fecha_anio"] //fecha anio a calcular
     * @param $data["fecha_semestre"] //fecha semestre a calcular
     * @param $data["modalidad"] //modalidad a calcular
     */
    if(empty($data["fecha_anio"])) throw new Exception("Dato no definido: fecha anio");
    if(empty($data["fecha_semestre"])) throw new Exception("Dato no definido: fecha semestre");
    if(empty($data["modalidad"])) throw new Exception("Dato no definido: modalidad");

    $render = [
        ["fecha_anio", "=", $data["fecha_anio"]],
        ["fecha_semestre", "=", $data["fecha_semestre"]],
        ["modalidad", "=", $data["modalidad"]]
    ];

    $count = Ma::count("comision",$render);
    if($count) throw new Exception("Ya existen comisiones para los parametros ingresados");
  }


}




