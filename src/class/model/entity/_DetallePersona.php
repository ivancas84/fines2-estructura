<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DetallePersonaEntity extends Entity {
  public $name = "detalle_persona";
  public $alias = "dp";
  public $nf = ['descripcion', 'creado', 'fecha', 'tipo'];
  public $mu = ['archivo', 'persona'];
  public $_u = [];
  public $notNull = ['id', 'descripcion', 'creado', 'persona'];
  public $unique = ['id'];


}
