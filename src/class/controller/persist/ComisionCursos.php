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

    $cargasHorarias = Ma::all("carga_horaria", $display);
    if(!count($cargasHorarias)) throw new Exception("No existen cargas horarias asociadas");

    $comisionBd = Ma::unique("comision", $comision);
    
    if (!empty($comisionBd)){
        $comision["id"] = $comisionBd["id"];
        $this->update("comision", $comision);
        $cursos = Ma::ids("curso",["comision","=",$comision["id"]]);
        $tieneCursos = (count($cursos)) ? true : false;
    } else {
        $comision["id"] = $this->insert("comision", $comision);
        $tieneCursos = false;
    }

    if(!$tieneCursos){
        foreach($cargasHorarias as $ch){
            $curso = [
                "comision" => $comision["id"],
                "carga_horaria" => $ch["id"],
            ];
            $this->insert("curso", $curso);
        }
    }

  }


}




