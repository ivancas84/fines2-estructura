<?php

require_once("class/model/Field.php");

class _FieldCursoAsignatura extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "asignatura";
  public $alias = "asi";


  public function getEntity(){ return new CursoEntity; }

  public function getEntityRef(){ return new AsignaturaEntity; }


}
