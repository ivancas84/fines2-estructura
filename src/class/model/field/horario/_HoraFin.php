<?php

require_once("class/model/Field.php");

class _FieldHorarioHoraFin extends Field {

  public $type = "time";
  public $fieldType = "nf";
  public $default = null;
  public $length = false;  
  public $name = "hora_fin";
  public $alias = "hf";
  public $entityName = "horario";


}
