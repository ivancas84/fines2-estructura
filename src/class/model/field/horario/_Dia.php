<?php

require_once("class/model/Field.php");

class _FieldHorarioDia extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "dia";
  public $alias = "dia";
  public $entityName = "horario";
  public $entityRefName = "dia";  


}
