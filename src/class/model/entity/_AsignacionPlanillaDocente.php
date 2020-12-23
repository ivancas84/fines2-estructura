<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AsignacionPlanillaDocenteEntity extends Entity {
  public $name = "asignacion_planilla_docente";
  public $alias = "apd";
  public $nf = ['insertado', 'comentario', 'reclamo'];
  public $mu = ['planilla_docente', 'toma'];
  public $_u = [];
  public $notNull = ['id', 'planilla_docente', 'toma', 'insertado', 'reclamo'];
  public $unique = ['id'];


}
