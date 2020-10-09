<?php

require_once("class/model/entity/_Comision.php");

class ComisionEntity extends _ComisionEntity  {
 
  public $admin = ['id', 'turno', 'division', 'comentario', 'autorizada', 'apertura', 'publicada', 'observaciones', 'sede', 'modalidad', 'planificacion', 'comision_siguiente', 'calendario', 'identificacion'];
  public $main = ["sede", "division", "calendario",  "planificacion"];
}
