<?php

require_once("class/controller/ModelTools.php");

require_once("function/array_combine_keys.php");
require_once("function/array_combine_key.php");


class DisposicionesAprobadasAlumnoComision {
  /**
   * Disposiciones aprobadas para los alumnos de una comision.
   * 
   * Extraer planificacion de la comision y calcular la cantidad de disposi-
   * ciones aprobadas por alumno de la comision.
   */

  protected $idComision; //id de comision
  protected $planificacion;
  /**
   * @property $planificacion: Planificacion de la comision.
   * 
   * Sera utilizado para filtrar las disposiciones de los alumnos.
   */

  public function main($id) {
    if(empty($id)) throw new Exception("Dato no definido: id comision");

    $this->idComision = $id;
    $this->alumnoComision_();
    $this->idAlumno_ = array_unique(array_column($this->alumnoComision_, "alumno"));
    $this->planificacion = $this->alumnoComision_[0]["com_planificacion"];
    return $this->container->getMt()->cantidadCalificacionesAprobadas_($this->idAlumno_,$this->planificacion);
  }

  protected function alumnoComision_(){
    $render = $this->container->getEntityRender();
    $render->addCondition(["comision","=",$this->idComision]);
    $render->setSize(0);
    $this->alumnoComision_ =  $this->container->getDb()->all("alumno_comision", $render);
  }



    


  
    


}




