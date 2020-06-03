<?php

require_once("class/model/Field.php");

class _FieldCalendarioInicio extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = false;
  public $main = false;
  public $name = "inicio";
  public $alias = "ini";


  public function getEntity(){ return Entity::getInstanceRequire('calendario'); }


}
