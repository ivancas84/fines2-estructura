<?php

require_once("class/model/Field.php");

class _FieldHorarioHoraInicio extends Field {

  public $type = "time";
  public $fieldType = "nf";
  public $default = null;
  public $length = false;  
  public $name = "hora_inicio";
  public $alias = "hi";
  public $entityName = "horario";


}
