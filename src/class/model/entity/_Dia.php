<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DiaEntity extends Entity {
  public $name = "dia";
  public $alias = "dia";
 
  public function getPk(){
    return $this->container->getField("dia", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("dia", "numero"),
      $this->container->getField("dia", "dia"),
    );
  }


}
