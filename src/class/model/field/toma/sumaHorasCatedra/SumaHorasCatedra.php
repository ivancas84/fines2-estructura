<?php

require_once("class/model/Field.php");

class FieldTomaSumaHorasCatedra extends Field {

  public $type = "int";
  public $hidden = true;
  public $admin = false;
  public $name = "suma_horas_catedra";
  public $alias = "shc";

  public function getEntity(){ return new TomaEntity; }
}
