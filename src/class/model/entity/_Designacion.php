<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DesignacionEntity extends Entity {
  public $name = "designacion";
  public $alias = "desi";
 
  public function getPk(){
    return $this->container->getField("designacion", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("designacion", "desde"),
      $this->container->getField("designacion", "hasta"),
      $this->container->getField("designacion", "alta"),
    );
  }

  public function getFieldsMu(){
    return array(
      $this->container->getField("designacion", "cargo"),
      $this->container->getField("designacion", "sede"),
      $this->container->getField("designacion", "persona"),
    );
  }


}
