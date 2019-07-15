<?php

require_once("class/model/Field.php");

class FieldInasistenciaArticuloMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "articulo";
  public $alias = "art";


  public function getEntity(){ return new InasistenciaEntity; }


}
