<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _TomaEntity extends Entity {
  public $name = "toma";
  public $alias = "toma";
 
  public function getPk(){
    return $this->container->getField("toma", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("toma", "fecha_toma"),
      $this->container->getField("toma", "estado"),
      $this->container->getField("toma", "observaciones"),
      $this->container->getField("toma", "comentario"),
      $this->container->getField("toma", "tipo_movimiento"),
      $this->container->getField("toma", "estado_contralor"),
      $this->container->getField("toma", "alta"),
    );
  }

  public function getFieldsMu(){
    return array(
      $this->container->getField("toma", "curso"),
      $this->container->getField("toma", "docente"),
      $this->container->getField("toma", "reemplazo"),
    );
  }


}
