<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DistribucionHorariaEntity extends Entity {
  public $name = "distribucion_horaria";
  public $alias = "dh";
 
  public function getPk(){
    return $this->container->getField("distribucion_horaria", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("distribucion_horaria", "horas_catedra"),
      $this->container->getField("distribucion_horaria", "dia"),
    );
  }

  public function getFieldsMu(){
    return array(
      $this->container->getField("distribucion_horaria", "asignatura"),
      $this->container->getField("distribucion_horaria", "planificacion"),
    );
  }


}
