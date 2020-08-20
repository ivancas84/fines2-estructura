<?php

require_once("class/model/Field.php");

class _FieldHorarioHoraFin extends Field {

  public $type = "time";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = false;
  public $main = false;
  public $name = "hora_fin";
  public $alias = "hf";


  public function getEntity(){ return Entity::getInstanceRequire('horario'); }


}
