<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _PlanillaDocenteEntity extends Entity {
  public $name = "planilla_docente";
  public $alias = "pd";
  public $main = ['id'];
  public $pk = ['id'];
  public $nf = ['numero', 'insertado'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'numero', 'insertado'];
  public $unique = ['id'];
  public $admin = ['id', 'numero', 'insertado'];



}
