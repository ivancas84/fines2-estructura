<?php

require_once("class/model/Field.php");

class FieldCursoTomaActiva extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "toma_activa";
  public $alias = "ta";
  public $admin = false;
  public $db = false;


  public function getEntity(){ return new CursoEntity; }

  public function getEntityRef(){ return new TomaEntity; }

}
