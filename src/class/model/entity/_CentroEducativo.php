<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _CentroEducativoEntity extends Entity {
  public $name = "centro_educativo";
  public $alias = "ce";
 
  public function getPk(){
    return $this->container->getField("centro_educativo", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("centro_educativo", "nombre"),
      $this->container->getField("centro_educativo", "cue"),
    );
  }

  public function getFieldsMu(){
    return array(
      $this->container->getField("centro_educativo", "domicilio"),
    );
  }


}
