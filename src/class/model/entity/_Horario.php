<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _HorarioEntity extends Entity {
  public $name = "horario";
  public $alias = "hora";
 
  public function getPk(){
    return $this->container->getField("horario", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("horario", "hora_inicio"),
      $this->container->getField("horario", "hora_fin"),
    );
  }

  public function getFieldsMu(){
    return array(
      $this->container->getField("horario", "curso"),
      $this->container->getField("horario", "dia"),
    );
  }


}
