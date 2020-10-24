<?php

require_once("class/model/Field.php");

class _FieldHorarioHoraInicio extends Field {

  public $type = "time";
  public $fieldType = "nf";
  public $default = null;
  public $name = "hora_inicio";
  public $alias = "hi";
  public $entityName = "horario";
  public $dataType = "time";  
  public $subtype = "time";  
  public $value = "datetime";  


}
