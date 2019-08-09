<?php

require_once("class/model/Field.php");

class FieldCursoComisionMain extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "comision";
  public $alias = "com";


  public function getEntity(){ return new CursoEntity; }

  public function getEntityRef(){ return new ComisionEntity; }


}
