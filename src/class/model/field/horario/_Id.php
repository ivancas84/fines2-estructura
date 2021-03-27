<?php

require_once("class/model/Field.php");

class _FieldHorarioId extends Field {

  public $type = "varchar";
  public $fieldType = "pk";
  public $default = null;
  public $name = "id";
  public $alias = "id";
  public $entityName = "horario";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
