<?php

require_once("class/model/Entity.php");

$structure = array (
  Entity::getInstanceRequire("alumno"),
  Entity::getInstanceRequire("asignatura"),
  Entity::getInstanceRequire("carga_horaria"),
  Entity::getInstanceRequire("clasificacion"),
  Entity::getInstanceRequire("clasificacion_plan"),
  Entity::getInstanceRequire("comision"),
  Entity::getInstanceRequire("coordinador"),
  Entity::getInstanceRequire("curso"),
  Entity::getInstanceRequire("dia"),
  Entity::getInstanceRequire("distribucion_horaria"),
  Entity::getInstanceRequire("division"),
  Entity::getInstanceRequire("domicilio"),
  Entity::getInstanceRequire("horario"),
  Entity::getInstanceRequire("id_persona"),
  Entity::getInstanceRequire("inasistencia"),
  Entity::getInstanceRequire("lugar_nacimiento"),
  Entity::getInstanceRequire("nomina"),
  Entity::getInstanceRequire("nomina2"),
  Entity::getInstanceRequire("nota"),
  Entity::getInstanceRequire("permiso"),
  Entity::getInstanceRequire("persona"),
  Entity::getInstanceRequire("plan"),
  Entity::getInstanceRequire("referente"),
  Entity::getInstanceRequire("rol"),
  Entity::getInstanceRequire("sede"),
  Entity::getInstanceRequire("telefono"),
  Entity::getInstanceRequire("tipo_sede"),
  Entity::getInstanceRequire("toma"),
  Entity::getInstanceRequire("usuario"),
);

  Entity::setStructure($structure);

