<?php

require_once("class/model/Field.php");

class FieldAlumnoPersonaMain extends Field {

  public $type = "bigint";
  public $fieldType = "_u";
  public $unique = true;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "persona";
  public $alias = "per";


  public function getEntity(){ return new AlumnoEntity; }

  public function getEntityRef(){ return new IdPersonaEntity; }


}
