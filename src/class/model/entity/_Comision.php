<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _ComisionEntity extends Entity {
  public $name = "comision";
  public $alias = "comi";
  public $main = ['id'];
  public $pk = ['id'];
  public $nf = ['turno', 'division', 'comentario', 'autorizada', 'apertura', 'publicada', 'observaciones', 'alta', 'identificacion'];
  public $mu = ['sede', 'modalidad', 'planificacion', 'comision_siguiente', 'calendario'];
  public $_u = [];
  public $notNull = ['id', 'division', 'autorizada', 'apertura', 'publicada', 'alta', 'sede', 'modalidad', 'calendario'];
  public $unique = ['id'];
  public $admin = ['id', 'turno', 'division', 'comentario', 'autorizada', 'apertura', 'publicada', 'observaciones', 'alta', 'sede', 'modalidad', 'planificacion', 'comision_siguiente', 'calendario', 'identificacion'];



}
