<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _ContralorEntity extends Entity {
  public $name = "contralor";
  public $alias = "cont";
 
  public function getPk(){
    return $this->container->getField("contralor", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("contralor", "fecha_contralor"),
      $this->container->getField("contralor", "fecha_consejo"),
      $this->container->getField("contralor", "insertado"),
    );
  }

  public function getFieldsMu(){
    return array(
      $this->container->getField("contralor", "planilla_docente"),
    );
  }


}
