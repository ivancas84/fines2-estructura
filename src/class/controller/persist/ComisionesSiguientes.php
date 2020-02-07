<?php


require_once("class/controller/Persist.php");

class ComisionesSiguientesPersist extends Persist {
  /**
   * Persistencia de cursos y comisiones
   */
  public function main($data){

    if(empty($data["fecha_anio"])) throw new Exception("Dato no definido: fecha anio");
    if(empty($data["fecha_semestre"])) throw new Exception("Dato no definido: fecha semestre");
    if(empty($data["modalidad"])) throw new Exception("Dato no definido: modalidad");

    $render = [
        ["fecha_anio", "=", $data["fecha_anio"]],
        ["fecha_semestre", "=", $data["fecha_semestre"]],
        ["modalidad", "=", $data["modalidad"]]            
    ];
  }


}




