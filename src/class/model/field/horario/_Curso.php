<?php

require_once("class/model/Field.php");

class _FieldHorarioCurso extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "curso";
  public $alias = "cur";


  public function getEntity(){ return new HorarioEntity; }

  public function getEntityRef(){ return new CursoEntity; }


}