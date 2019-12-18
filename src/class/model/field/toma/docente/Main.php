<?php

require_once("class/model/Field.php");

class FieldTomaDocenteMain extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "docente";
  public $alias = "doc";


  public function getEntity(){ return new TomaEntity; }

  public function getEntityRef(){ return new PersonaEntity; }


}
