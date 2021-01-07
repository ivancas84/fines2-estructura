<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _PlanillaDocenteEntity extends Entity {
  public $name = "planilla_docente";
  public $alias = "pd";
  public $nf = ['numero', 'insertado', 'fecha_contralor', 'fecha_consejo', 'observaciones'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'numero', 'insertado'];
  public $unique = ['id'];


}
