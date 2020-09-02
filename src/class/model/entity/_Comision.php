<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _ComisionEntity extends Entity {
  public $name = "comision";
  public $alias = "comi";
 
  public function getPk(){
    return $this->container->getField("comision", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("comision", "turno"),
      $this->container->getField("comision", "division"),
      $this->container->getField("comision", "comentario"),
      $this->container->getField("comision", "autorizada"),
      $this->container->getField("comision", "apertura"),
      $this->container->getField("comision", "publicada"),
      $this->container->getField("comision", "observaciones"),
      $this->container->getField("comision", "alta"),
    );
  }

  public function getFieldsMu(){
    return array(
      $this->container->getField("comision", "sede"),
      $this->container->getField("comision", "modalidad"),
      $this->container->getField("comision", "planificacion"),
      $this->container->getField("comision", "comision_siguiente"),
      $this->container->getField("comision", "calendario"),
    );
  }


}
