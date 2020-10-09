<?php

require_once("class/model/entity/_Sede.php");

class SedeEntity extends _SedeEntity  {
 
  public $uniqueMultiple = ["numero", "centro_educativo"];
  public $admin = ['id', 'numero', 'nombre', 'observaciones', 'baja', 'domicilio', 'tipo_sede', 'centro_educativo'];
  public $main = ["numero", "nombre"];
}
