<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AsignaturaEntity extends Entity {
  public $name = "asignatura";
  public $alias = "asig";
 
  public function getPk(){
    return $this->container->getField("asignatura", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("asignatura", "nombre"),
      $this->container->getField("asignatura", "formacion"),
      $this->container->getField("asignatura", "clasificacion"),
      $this->container->getField("asignatura", "codigo"),
      $this->container->getField("asignatura", "perfil"),
    );
  }


}
