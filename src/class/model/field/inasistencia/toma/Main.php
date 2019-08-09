<?php

require_once("class/model/Field.php");

class FieldInasistenciaTomaMain extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "toma";
  public $alias = "tom";


  public function getEntity(){ return new InasistenciaEntity; }

  public function getEntityRef(){ return new TomaEntity; }


}
