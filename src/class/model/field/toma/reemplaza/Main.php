<?php

require_once("class/model/Field.php");

class FieldTomaReemplazaMain extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "reemplaza";
  public $alias = "ree";


  public function getEntity(){ return new TomaEntity; }

  public function getEntityRef(){ return new IdPersonaEntity; }


}
