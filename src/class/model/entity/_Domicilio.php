<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DomicilioEntity extends Entity {
  public $name = "domicilio";
  public $alias = "domi";
 
  public function getPk(){
    return $this->container->getField("domicilio", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("domicilio", "calle"),
      $this->container->getField("domicilio", "entre"),
      $this->container->getField("domicilio", "numero"),
      $this->container->getField("domicilio", "piso"),
      $this->container->getField("domicilio", "departamento"),
      $this->container->getField("domicilio", "barrio"),
      $this->container->getField("domicilio", "localidad"),
    );
  }


}
