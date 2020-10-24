<?php

require_once("class/model/Field.php");

class _FieldHorarioHoraFin extends Field {

  public $type = "time";
  public $fieldType = "nf";
  public $default = null;
  public $name = "hora_fin";
  public $alias = "hf";
  public $entityName = "horario";
  public $dataType = "time";  
  public $subtype = "time";  
  public $value = "datetime";  


}
