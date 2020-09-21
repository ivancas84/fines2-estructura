<?php

require_once("class/model/Field.php");

class _FieldDetallePersonaArchivo extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "archivo";
  public $alias = "arc";


  public function getEntity(){ return $this->container->getEntity('detalle_persona'); }

  public function getEntityRef(){ return $this->container->getEntity('file'); }


}
