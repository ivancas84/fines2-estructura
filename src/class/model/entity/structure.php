<?php

require_once("class/model/Entity.php");

$structure = array (
  Entity::getInstanceRequire("asignatura"),
  Entity::getInstanceRequire("calendario"),
  Entity::getInstanceRequire("cargo"),
  Entity::getInstanceRequire("centro_educativo"),
  Entity::getInstanceRequire("comision"),
  Entity::getInstanceRequire("contralor"),
  Entity::getInstanceRequire("curso"),
  Entity::getInstanceRequire("designacion"),
  Entity::getInstanceRequire("dia"),
  Entity::getInstanceRequire("distribucion_horaria"),
  Entity::getInstanceRequire("domicilio"),
  Entity::getInstanceRequire("email"),
  Entity::getInstanceRequire("file"),
  Entity::getInstanceRequire("horario"),
  Entity::getInstanceRequire("modalidad"),
  Entity::getInstanceRequire("persona"),
  Entity::getInstanceRequire("plan"),
  Entity::getInstanceRequire("planificacion"),
  Entity::getInstanceRequire("planilla_docente"),
  Entity::getInstanceRequire("sede"),
  Entity::getInstanceRequire("telefono"),
  Entity::getInstanceRequire("tipo_sede"),
  Entity::getInstanceRequire("toma"),
);

  Entity::setStructure($structure);

