<?php

require_once("class/model/Field.php");

class _FieldDesignacionDesde extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = false;
  public $main = false;
  public $name = "desde";
  public $alias = "des";


  public function getEntity(){ return Entity::getInstanceRequire('designacion'); }


}
