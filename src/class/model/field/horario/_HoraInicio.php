<?php

require_once("class/model/Field.php");

class _FieldHorarioHoraInicio extends Field {

  public $type = "time";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = false;
  public $main = false;
  public $name = "hora_inicio";
  public $alias = "hi";


  public function getEntity(){ return $this->container->getEntity('horario'); }


}
