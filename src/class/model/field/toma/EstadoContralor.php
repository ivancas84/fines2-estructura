<?php

require_once("class/model/field/toma/EstadoContralor.php");

class FieldTomaEstadoContralor extends _FieldTomaEstadoContralor {

  public $subtype = "select";
  public $selectValues = array('Pasar', 'Modificar', 'No pasar');  

}
