<?php

require_once("class/model/entity/_Sede.php");

class SedeEntity extends _SedeEntity  {
 

  public function getFieldsUniqueMultiple(){ 
    return array(
      $this->container->getField("sede", "numero"),
      $this->container->getField("sede", "centro_educativo"),
    ); 
  }
}
