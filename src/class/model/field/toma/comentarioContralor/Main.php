<?php

require_once("class/model/Field.php");

class FieldTomaComentarioContralorMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "comentario_contralor";
  public $alias = "cc";


  public function getEntity(){ return new TomaEntity; }


}
