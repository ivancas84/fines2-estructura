<?php

require_once("class/model/Field.php");

class FieldComisionHoraInicio extends Field {

  public $type = "time";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = false;
  public $main = false;
  public $name = "hora_inicio";
  public $alias = "hi";

  public $db = false;
  public $admin = false;


  public function getEntity(){ return new ComisionEntity; }


}
