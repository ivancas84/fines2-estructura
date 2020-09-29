<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _CursoEntity extends Entity {
  public $name = "curso";
  public $alias = "curs";
 
  public function getPk(){
    return $this->container->getField("curso", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("curso", "horas_catedra"),
      $this->container->getField("curso", "ige"),
      $this->container->getField("curso", "numero_documento_designado"),
      $this->container->getField("curso", "alta"),
    );
  }

  public function getFieldsMu(){
    return array(
      $this->container->getField("curso", "comision"),
      $this->container->getField("curso", "asignatura"),
    );
  }


}
