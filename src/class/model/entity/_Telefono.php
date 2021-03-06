<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _TelefonoEntity extends Entity {
  public $name = "telefono";
  public $alias = "tele";
  public $nf = ['tipo', 'prefijo', 'numero', 'insertado', 'eliminado'];
  public $mu = ['persona'];
  public $_u = [];
  public $notNull = ['id', 'numero', 'insertado', 'persona'];
  public $unique = ['id'];


}
