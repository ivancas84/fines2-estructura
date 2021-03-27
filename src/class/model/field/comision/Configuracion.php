<?php

require_once("class/model/field/comision/_Configuracion.php");

class FieldComisionConfiguracion extends _FieldComisionConfiguracion {
  public $subtype = "select";
  public $selectValues = ["Histórica", "Nueva"];  
}
