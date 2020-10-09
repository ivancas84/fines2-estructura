<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _HorarioEntity extends Entity {
  public $name = "horario";
  public $alias = "hora";
  public $main = ['id'];
  public $pk = ['id'];
  public $nf = ['hora_inicio', 'hora_fin'];
  public $mu = ['curso', 'dia'];
  public $_u = [];
  public $notNull = ['id', 'hora_inicio', 'hora_fin', 'curso', 'dia'];
  public $unique = ['id'];
  public $admin = ['id', 'hora_inicio', 'hora_fin', 'curso', 'dia'];



}
