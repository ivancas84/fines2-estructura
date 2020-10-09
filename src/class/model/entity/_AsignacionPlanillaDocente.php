<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AsignacionPlanillaDocenteEntity extends Entity {
  public $name = "asignacion_planilla_docente";
  public $alias = "apd";
  public $main = ['id'];
  public $pk = ['id'];
  public $nf = ['insertado'];
  public $mu = ['planilla_docente', 'toma'];
  public $_u = [];
  public $notNull = ['id', 'planilla_docente', 'toma', 'insertado'];
  public $unique = ['id'];
  public $admin = ['id', 'planilla_docente', 'toma', 'insertado'];



}
