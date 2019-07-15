<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class DivisionEntityMain extends Entity {
  public $name = "division";
  public $alias = "divi";
 
  public function getPk(){
    return new FieldDivisionId;
  }

  public function getFieldsNf(){
    return array(
      new FieldDivisionSerie,
      new FieldDivisionTurno,
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldDivisionPlan,
      new FieldDivisionSede,
    );
  }


}
