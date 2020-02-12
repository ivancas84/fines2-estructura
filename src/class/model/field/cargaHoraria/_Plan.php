<?php

require_once("class/model/Field.php");

class _FieldCargaHorariaPlan extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "plan";
  public $alias = "pla";


  public function getEntity(){ return new CargaHorariaEntity; }

  public function getEntityRef(){ return new PlanEntity; }


}