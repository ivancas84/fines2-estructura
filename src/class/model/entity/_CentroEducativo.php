<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _CentroEducativoEntity extends Entity {
  public $name = "centro_educativo";
  public $alias = "ce";
  public $main = ['id'];
  public $pk = ['id'];
  public $nf = ['nombre', 'cue'];
  public $mu = ['domicilio'];
  public $_u = [];
  public $notNull = ['id', 'nombre'];
  public $unique = ['id', 'cue'];
  public $admin = ['id', 'nombre', 'cue', 'domicilio'];



}
