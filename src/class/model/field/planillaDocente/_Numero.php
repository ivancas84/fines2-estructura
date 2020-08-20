<?php

require_once("class/model/Field.php");

class _FieldPlanillaDocenteNumero extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "255";
  public $main = false;
  public $name = "numero";
  public $alias = "num";


  public function getEntity(){ return Entity::getInstanceRequire('planilla_docente'); }


}
