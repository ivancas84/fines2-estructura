<?php
require_once("model/entityOptions/Mapping.php");

class CursoMapping extends MappingEntityOptions{

  public function label() {
    return "CONCAT(
      sede.numero, 
      comision.division,
      '/',
      IF(
        planificacion.id, 
        CONCAT(
          planificacion.anio,
          planificacion.semestre
        ), 
        ''
      ),
      ' ',
      asignatura.nombre,
      ' ',
      sede.nombre
    )";
  }


}
