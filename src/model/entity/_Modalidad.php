<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _ModalidadEntity extends Entity {
  public $name = "modalidad";
  public $alias = "moda";
  public $nf = ['nombre'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'nombre'];
  public $unique = ['id', 'nombre'];


}
