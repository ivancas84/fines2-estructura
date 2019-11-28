<?php

require_once("class/model/Field.php");

class FieldPersonaNumeroDocumentoMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = true;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "numero_documento";
  public $alias = "nd";


  public function getEntity(){ return new PersonaEntity; }


}
