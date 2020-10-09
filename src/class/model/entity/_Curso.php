<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _CursoEntity extends Entity {
  public $name = "curso";
  public $alias = "curs";
  public $main = ['id'];
  public $pk = ['id'];
  public $nf = ['horas_catedra', 'ige', 'numero_documento_designado', 'alta'];
  public $mu = ['comision', 'asignatura'];
  public $_u = [];
  public $notNull = ['id', 'horas_catedra', 'comision', 'asignatura', 'alta'];
  public $unique = ['id'];
  public $admin = ['id', 'horas_catedra', 'ige', 'numero_documento_designado', 'comision', 'asignatura', 'alta'];



}
