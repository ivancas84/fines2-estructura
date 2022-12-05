<?php
require_once("model/entityOptions/Mapping.php");

class DisposicionMapping extends MappingEntityOptions{

  public function label() {
    return "CONCAT_WS(' ',
      asignatura.nombre, 
      planificacion.anio,
      planificacion.semestre,
      plan.orientacion,
      plan.resolucion,
      plan.distribucion_horaria
    )";
  }

  


}
