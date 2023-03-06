<?php

require_once("controller/Persist.php");
require_once("controller/ModelTools.php");
require_once("model/db/Dba.php");

class ComisionPersist extends Persist {
  protected $entity_name = "comision";

  public function main($comision) {
    /**
     * Persistencia de comisiones
     * Si se activo el flag crear_cursos, se insertar los cursos de la comision (si no existen)
     */

    Dba::dbInstance();
    try {
    
      
      if ( $comision["crear_cursos"] ) {
        $cargasHorarias = ModelTools::cargasHorariasDePlanificacion( $comision["planificacion"] );
        if(!count($cargasHorarias)) throw new Exception("No existen cargas horarias asociadas a la planificacion");
      }

      if ( $comision["id"] ) {
        $comisionBd = Ma::get( "comision", $comision["id"] );
        $this->update( "comision", $comision );
        $tieneCursos =  Ma::count("curso",["comision","=",$comision["id"]]);
      } else {
        $comision["id"] = $this->insert("comision", $comision);
        $tieneCursos = false;
      }
      
      if ( $comision["crear_cursos"] && !$tieneCursos ) {
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
      
    } finally {
      Dba::dbCloseAll();
    }
  }
 
}
