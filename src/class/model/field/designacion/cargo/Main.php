<?php

require_once("class/model/Field.php");

class FieldDesignacionCargoMain extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "cargo";
  public $alias = "car";


  public function getEntity(){ return new DesignacionEntity; }

  public function getEntityRef(){ return new CargoEntity; }


}