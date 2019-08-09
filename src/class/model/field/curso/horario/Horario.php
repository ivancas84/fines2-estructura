<?php

require_once("class/model/Field.php");

class FieldCursoHorario extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "100";
  public $main = false;
  public $name = "horario";
  public $alias = "hor";
  public $admin = false;
  public $db = false;
  
  public function getEntity(){ return new CursoEntity; }

}
