<?php

require_once("class/model/field/toma/_TipoMovimiento.php");

class FieldTomaTipoMovimiento extends _FieldTomaTipoMovimiento {

  public $subtype = "select_text";
  public $selectValues = array('AI', 'CP', 'CC');

}
