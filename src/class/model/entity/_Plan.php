<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _PlanEntity extends Entity {
  public $name = "plan";
  public $alias = "plan";
 
  public function getPk(){
    return $this->container->getField("plan", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("plan", "orientacion"),
      $this->container->getField("plan", "resolucion"),
      $this->container->getField("plan", "distribucion_horaria"),
    );
  }


}
