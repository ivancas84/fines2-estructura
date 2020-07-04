<?php

require_once("class/model/field/toma/_EstadoContralor.php");

class FieldTomaEstadoContralor extends _FieldTomaEstadoContralor {

  public $subtype = "select_text";
  public $selectValues = array('Pasar', 'Modificar', 'No pasar');  

}
