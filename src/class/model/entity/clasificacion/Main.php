<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class ClasificacionEntityMain extends Entity {
  public $name = "clasificacion";
  public $alias = "clas";
 
  public function getPk(){
    return new FieldClasificacionId;
  }

  public function getFieldsNf(){
    return array(
      new FieldClasificacionNombre,
    );
  }


}
