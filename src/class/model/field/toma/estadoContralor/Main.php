<?php

require_once("class/model/Field.php");

class FieldTomaEstadoContralorMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = "Pasar";
  public $length = "45";
  public $main = false;
  public $name = "estado_contralor";
  public $alias = "ec";


  public function getEntity(){ return new TomaEntity; }


}
