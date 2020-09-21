<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _CalendarioEntity extends Entity {
  public $name = "calendario";
  public $alias = "cale";
 
  public function getPk(){
    return $this->container->getField("calendario", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("calendario", "inicio"),
      $this->container->getField("calendario", "fin"),
      $this->container->getField("calendario", "anio"),
      $this->container->getField("calendario", "semestre"),
      $this->container->getField("calendario", "insertado"),
    );
  }


}
