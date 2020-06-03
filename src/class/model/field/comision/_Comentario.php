<?php

require_once("class/model/Field.php");

class _FieldComisionComentario extends Field {

  public $type = "text";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "65535";
  public $main = false;
  public $name = "comentario";
  public $alias = "com";


  public function getEntity(){ return Entity::getInstanceRequire('comision'); }


}
