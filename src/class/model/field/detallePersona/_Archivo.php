<?php

require_once("class/model/Field.php");

class _FieldDetallePersonaArchivo extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "archivo";
  public $alias = "arc";


  public function getEntity(){ return Entity::getInstanceRequire('detalle_persona'); }

  public function getEntityRef(){ return Entity::getInstanceRequire('file'); }


}
