<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _ModalidadEntity extends Entity {
  public $name = "modalidad";
  public $alias = "moda";
 
  public function getPk(){
    return $this->container->getField("modalidad", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("modalidad", "nombre"),
    );
  }


}
