<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _CentroEducativoEntity extends Entity {
  public $name = "centro_educativo";
  public $alias = "ce";
  public $nf = ['nombre', 'cue', 'observaciones'];
  public $mu = ['domicilio'];
  public $_u = [];
  public $notNull = ['id', 'nombre'];
  public $unique = ['id', 'cue'];


}
