<?php

require_once("class/model/Field.php");

class _FieldCursoNumeroDocumentoDesignado extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "numero_documento_designado";
  public $alias = "ndd";


  public function getEntity(){ return $this->container->getEntity('curso'); }


}
