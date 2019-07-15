<?php

require_once("class/model/Field.php");

class FieldHorarioHorasCatedra extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = false;
  public $main = false;
  public $name = "horas_catedra";
  public $alias = "hc";
  public $hidden = true;
  public $admin = false;
  public $db = false;



  public function getEntity(){ return new HorarioEntity; }


}
