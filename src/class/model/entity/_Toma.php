<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _TomaEntity extends Entity {
  public $name = "toma";
  public $alias = "toma";
  public $nf = ['fecha_toma', 'estado', 'observaciones', 'comentario', 'tipo_movimiento', 'estado_contralor', 'alta'];
  public $mu = ['curso', 'docente', 'reemplazo', 'planilla_docente'];
  public $_u = [];
  public $notNull = ['id', 'tipo_movimiento', 'alta', 'curso'];
  public $unique = ['id'];


}
