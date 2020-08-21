<?php

require_once("class/model/entity/_Sede.php");

class SedeEntity extends _SedeEntity  {
 

  public function getFieldsUniqueMultiple(){ 
    return array(
      Field::getInstanceRequire("sede", "numero"),
      Field::getInstanceRequire("sede", "centro_educativo"),
    ); 
  }
}
