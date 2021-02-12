<?php

require_once("class/model/entity/_Comision.php");

class ComisionEntity extends _ComisionEntity  {
 
  public $admin = ['id', 'turno', 'division', 'comentario', 'autorizada', 'apertura', 'publicada', 'observaciones', 'sede', 'modalidad', 'planificacion', 'comision_siguiente', 'calendario', 'identificacion'];
  public $main = ["sede", "division", "calendario",  "planificacion"];
  public $identifier = ["sed-numero","division", "pla-anio", "pla-semestre"]; 
  /**
   * identificador valido para modalidad fines y secundaria con oficios
   */
}
