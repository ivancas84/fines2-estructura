<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class RolEntityMain extends Entity {
  public $name = "rol";
  public $alias = "rol";
 
  public function getPk(){
    return new FieldRolId;
  }

  public function getFieldsNf(){
    return array(
      new FieldRolDescripcion,
      new FieldRolDetalle,
    );
  }


}
