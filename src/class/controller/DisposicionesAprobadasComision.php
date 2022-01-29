<?php

require_once("class/controller/ModelTools.php");

require_once("function/array_combine_keys.php");
require_once("function/array_combine_key.php");


class DisposicionesAprobadasComision {
  /**
   * Extraer tramo de la comision y calcular la cantidad de disposiciones a-
   * probadas por alumno de la comision.
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
    $this->idAlumno_();
    return $this->cantidadCalificaciones_();
  }

  protected function alumnoComision_(){
    $render = $this->container->getRender();
    $render->addCondition(["comision","=",$this->idComision]);
    $this->alumnoComision_ =  $this->container->getDb()->all("alumno_comision", $render);
  }

  protected function idAlumno_(){
    $this->idAlumno_ = array_unique(array_column($this->alumnoComision_, "alumno"));
    $this->planificacion = $this->alumnoComision_[0]["com_planificacion"];
    
  }

  protected function cantidadCalificaciones_(){
    $render = $this->container->getRender();
    $render->addCondition(["dis_planificacion","=",$this->planificacion]);
    $render->addCondition(["alumno","=",$this->idAlumno_]);
    $render->addFields(["alumno", "cantidad"=> "count"]);
    $render->setSize(0);
    $render->setGroup(["alumno"]);
    return $this->container->getDb()->select("calificacion",$render);

    
  }



  


  
    


}




