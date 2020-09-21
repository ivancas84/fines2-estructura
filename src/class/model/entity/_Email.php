<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _EmailEntity extends Entity {
  public $name = "email";
  public $alias = "emai";
 
  public function getPk(){
    return $this->container->getField("email", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("email", "email"),
      $this->container->getField("email", "verificado"),
      $this->container->getField("email", "insertado"),
      $this->container->getField("email", "eliminado"),
    );
  }

  public function getFieldsMu(){
    return array(
      $this->container->getField("email", "persona"),
    );
  }


}
