<?php

require_once("class/model/Field.php");

class FieldSedeTipoSedeMain extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "19";
  public $main = false;
  public $name = "tipo_sede";
  public $alias = "ts";


  public function getEntity(){ return new SedeEntity; }

  public function getEntityRef(){ return new TipoSedeEntity; }


}
