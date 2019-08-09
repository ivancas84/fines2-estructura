<?php

require_once("class/model/Field.php");

class FieldTomaCursoMain extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "curso";
  public $alias = "cur";


  public function getEntity(){ return new TomaEntity; }

  public function getEntityRef(){ return new CursoEntity; }


}
