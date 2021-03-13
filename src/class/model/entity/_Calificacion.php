<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _CalificacionEntity extends Entity {
  public $name = "calificacion";
  public $alias = "cali";
  public $nf = ['nota1', 'nota2', 'nota3', 'nota_final', 'crec'];
  public $mu = ['curso', 'persona'];
  public $_u = [];
  public $notNull = ['id', 'nota_final', 'persona'];
  public $unique = ['id'];


}
