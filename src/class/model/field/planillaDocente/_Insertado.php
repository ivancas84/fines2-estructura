<?php

require_once("class/model/Field.php");

class _FieldPlanillaDocenteInsertado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = "current_timestamp()";
  public $length = false;
  public $main = false;
  public $name = "insertado";
  public $alias = "ins";


  public function getEntity(){ return Entity::getInstanceRequire('planilla_docente'); }


}
