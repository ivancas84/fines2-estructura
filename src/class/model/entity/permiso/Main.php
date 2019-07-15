<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class PermisoEntityMain extends Entity {
  public $name = "permiso";
  public $alias = "perm";
 
  public function getPk(){
    return new FieldPermisoId;
  }

  public function getFieldsNf(){
    return array(
      new FieldPermisoAlta,
      new FieldPermisoBaja,
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldPermisoRol,
      new FieldPermisoPersona,
    );
  }


}
