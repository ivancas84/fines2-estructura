<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _TelefonoEntity extends Entity {
  public $name = "telefono";
  public $alias = "tele";
 
  public function getPk(){
    return $this->container->getField("telefono", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("telefono", "tipo"),
      $this->container->getField("telefono", "prefijo"),
      $this->container->getField("telefono", "numero"),
      $this->container->getField("telefono", "insertado"),
      $this->container->getField("telefono", "eliminado"),
    );
  }

  public function getFieldsMu(){
    return array(
      $this->container->getField("telefono", "persona"),
    );
  }


}
