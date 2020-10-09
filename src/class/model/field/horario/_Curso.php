<?php

require_once("class/model/Field.php");

class _FieldHorarioCurso extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "curso";
  public $alias = "cur";
  public $entityName = "horario";
  public $entityRefName = "curso";  


}
