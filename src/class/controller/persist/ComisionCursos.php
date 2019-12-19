<?php


require_once("class/controller/Persist.php");

class ComisionCursosPersist extends Persist {
  /**
   * Persistencia de cursos y comisiones
   */
  public function main($data){
    foreach($data as $d) {
        switch($d["entity"]) {
            case "comision": $comision = $d["row"]; break;
        }                    
    }

    if(empty($comision["anio"])) throw new Exception("No se encuentran definido el año");
    if(empty($comision["semestre"])) throw new Exception("No se encuentran definido el semestre");

    $display = [
        ["anio", "=", $comision["anio"]],
        ["semestre", "=", $comision["semestre"]],
        ["plan", "=", $comision["plan"]]            
    ];

    $cargaHorarias = Ma::all("carga_horaria", $display);
    if(!count($cargaHorarias)) throw new Exception("No existen cargas horarias asociadas");

    $comisionBd = Ma::uniqueOrNull("comision", $comision);
    
    if (!empty($comisionBd)){
        $comision["id"] = $comisionBd["id"];
        Sqlo::getInstanceRequire("comision")->update($comision);
    }



        if(isset($domicilio)) {
            if (!empty($ce_bd["domicilio"])) $domicilio["id"] = $ce_bd["domicilio"];    
        } else {
            if (!empty($ce_bd["domicilio"])) $deleteDomicilio = $ce_bd["domicilio"];
            $centroEducativo["domicilio"] = null;
        }
    }

}




