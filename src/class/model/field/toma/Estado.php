<?php

require_once("class/model/field/toma/_Estado.php");

class FieldTomaEstado extends _FieldTomaEstado {

  public $subtype = "select_text";
  public $selectValues = array('Aprobada', 'Pendiente', 'Renuncia', 'Error', 'Baja', 'Modificada', 'Observada');

}
