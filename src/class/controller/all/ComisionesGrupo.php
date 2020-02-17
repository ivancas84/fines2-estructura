<?php


require_once("class/controller/All.php");
require_once("class/model/Ma.php");
require_once("class/model/Values.php");
require_once("class/controller/persist/ComisionCursos.php");



class ComisionesGrupoAll extends All {
  /**
   * Persistencia de cursos y comisiones
   */
  protected $entityName = "comisiones_grupo";


  public function main($data){
    /**
     * @param $data["fecha_anio"]  
     * @param $data["fecha_semestre"]
     * @param $data["modalidad"]
     * @param $data["centro_educativo"]  
     */
    if(empty($data["fecha_anio"])) throw new Exception("Dato no definido: fecha anio");
    if(empty($data["fecha_semestre"])) throw new Exception("Dato no definido: fecha semestre");
    if(empty($data["modalidad"])) throw new Exception("Dato no definido: modalidad");
    if(empty($data["centro_educativo"])) throw new Exception("Dato no definido: centro educativo");

    $render = [
      ["fecha_anio", "=", $p["fecha_anio"]],
      ["fecha_semestre", "=", $p["fecha_semestre"]],
      ["modalidad", "=", $p["modalidad"]],
      ["sed_centro_educativo", "=", $p["centro_educativo"]]
    ];

    return Ma::all("comision",$render);  
  }


}




