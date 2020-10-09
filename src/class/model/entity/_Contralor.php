<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _ContralorEntity extends Entity {
  public $name = "contralor";
  public $alias = "cont";
  public $main = ['id'];
  public $pk = ['id'];
  public $nf = ['fecha_contralor', 'fecha_consejo', 'insertado'];
  public $mu = ['planilla_docente'];
  public $_u = [];
  public $notNull = ['id', 'insertado', 'planilla_docente'];
  public $unique = ['id'];
  public $admin = ['id', 'fecha_contralor', 'fecha_consejo', 'insertado', 'planilla_docente'];



}
