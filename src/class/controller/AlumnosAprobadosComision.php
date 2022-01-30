<?php

require_once("class/controller/ModelTools.php");

require_once("function/array_combine_keys.php");
require_once("function/array_combine_key.php");
require_once("function/array_group_value.php");


class AlumnosAprobadosComision   {
  /**
   * Disposiciones aprobadas para los alumnos de una comision.
   * 
   * Extraer planificacion de la comision y calcular la cantidad de disposi-
   * ciones aprobadas por alumno de la comision.
   */

  protected $idComision_; //ids de comision
  protected $planificacion;
  /**
   * @property $planificacion: Planificacion de la comision.
   * 
   * Sera utilizado para filtrar las disposiciones de los alumnos.
   */

  protected $response = [];
  public function main(array $idComision_) {
    if(empty($idComision_)) throw new Exception("Dato no definido: id comision");

    $this->idComision_ = $idComision_;
    
    $this->alumnoComision_();
    
    foreach($this->alumnoComision_ as $idComision => $alumnoComision_)
      $this->cantidadAprobadosComision($idComision,$alumnoComision_);
    
    return $this->response;

  }

  protected function alumnoComision_(){
    $render = $this->container->getRender();
    $render->addCondition(["comision","=",$this->idComision_]);
    $render->setSize(0);
    $this->alumnoComision_ = array_group_value(
      $this->container->getDb()->all("alumno_comision", $render),
      "comision"
    );  
  }


  protected function cantidadAprobadosComision($idComision,$alumnoComision_){
    $idAlumno_ = array_unique(array_column($alumnoComision_, "alumno"));
    $planificacion = $alumnoComision_[0]["com_planificacion"];
    $cantidad_ = $this->container->getMt()->cantidadCalificacionesAprobadas_($idAlumno_, $planificacion);
    $total = 0;
    foreach($cantidad_ as $c){
      if($c["cantidad"]>=3) $total++;
    }

    array_push($this->response, [
      "comision" => $idComision,
      "cantidad_aprobados" => $total,
    ]);
  }

}




