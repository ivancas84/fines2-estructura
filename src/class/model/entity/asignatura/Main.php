<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class AsignaturaEntityMain extends Entity {
  public $name = "asignatura";
  public $alias = "asig";
 
  public function getPk(){
    return new FieldAsignaturaId;
  }

  public function getFieldsNf(){
    return array(
      new FieldAsignaturaNombre,
      new FieldAsignaturaFormacion,
      new FieldAsignaturaClasificacion,
      new FieldAsignaturaCodigo,
      new FieldAsignaturaPerfil,
    );
  }


}
