<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _SedeEntity extends Entity {
  public $name = "sede";
  public $alias = "sede";
 
  public function getPk(){
    return $this->container->getField("sede", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("sede", "numero"),
      $this->container->getField("sede", "nombre"),
      $this->container->getField("sede", "observaciones"),
      $this->container->getField("sede", "alta"),
      $this->container->getField("sede", "baja"),
    );
  }

  public function getFieldsMu(){
    return array(
      $this->container->getField("sede", "domicilio"),
      $this->container->getField("sede", "tipo_sede"),
      $this->container->getField("sede", "centro_educativo"),
    );
  }


}
