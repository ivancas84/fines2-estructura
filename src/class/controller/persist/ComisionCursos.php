<?php


require_once("class/controller/Persist.php");

class ComisionCursosPersist extends Persist {

  public $id;
  /**
   * id de la comision persistida
   */

  /**
   * Persistencia de cursos y comisiones
   */
  public function main($comision){
    if(empty($comision["anio"])) throw new Exception("No se encuentran definido el año");
    if(empty($comision["semestre"])) throw new Exception("No se encuentran definido el semestre");

    $display = [
        ["anio", "=", $comision["anio"]],
        ["semestre", "=", $comision["semestre"]],
        ["plan", "=", $comision["plan"]]            
    ];

    $cargasHorarias = ModelTools::cargasHorarias($comision["plan"], $comision["anio"], $comision["semestre"]);
    if(!count($cargasHorarias)) throw new Exception("No existen cargas horarias asociadas");

    $comisionBd = Ma::unique("comision", $comision);
    
    if (!empty($comisionBd)){
        $comision["id"] = $comisionBd["id"];
        $this->update("comision", $comision);
        $tieneCursos =  Ma::count("curso",["comision","=",$comision["id"]]);
    } else {
        $comision["id"] = $this->insert("comision", $comision);
        $tieneCursos = false;
    }

    if(!$tieneCursos){
        foreach($cargasHorarias as $ch){
            $curso = [
                "comision" => $comision["id"],
                "asignatura" => $ch["asignatura"],
                "horas_catedra" => $ch["sum_horas_catedra"],
            ];
            $this->insert("curso", $curso);
        }
    }

    return $comision["id"];
  }


}




