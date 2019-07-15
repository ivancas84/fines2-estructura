<?php

require_once("class/model/Field.php");

class FieldSedeDependenciaMain extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "dependencia";
  public $alias = "dep";


  public function getEntity(){ return new SedeEntity; }

  public function getEntityRef(){ return new SedeEntity; }


}
