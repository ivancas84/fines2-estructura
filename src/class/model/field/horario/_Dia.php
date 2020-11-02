<?php

require_once("class/model/Field.php");

class _FieldHorarioDia extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "dia";
  public $alias = "dia";
  public $entityName = "horario";
  public $entityRefName = "dia";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
