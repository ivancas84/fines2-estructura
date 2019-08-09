<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class DiaEntityMain extends Entity {
  public $name = "dia";
  public $alias = "dia";
 
  public function getPk(){
    return new FieldDiaId;
  }

  public function getFieldsNf(){
    return array(
      new FieldDiaNumero,
      new FieldDiaDia,
    );
  }


}
