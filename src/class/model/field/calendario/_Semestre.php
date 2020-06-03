<?php

require_once("class/model/Field.php");

class _FieldCalendarioSemestre extends Field {

  public $type = "smallint";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "5";
  public $main = false;
  public $name = "semestre";
  public $alias = "sem";


  public function getEntity(){ return Entity::getInstanceRequire('calendario'); }


}