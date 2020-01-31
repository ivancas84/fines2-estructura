<?php

require_once("class/model/Entity.php");

$structure = array (
  Entity::getInstanceRequire("asignatura"),
  Entity::getInstanceRequire("carga_horaria"),
  Entity::getInstanceRequire("cargo"),
  Entity::getInstanceRequire("centro_educativo"),
  Entity::getInstanceRequire("comision"),
  Entity::getInstanceRequire("curso"),
  Entity::getInstanceRequire("designacion"),
  Entity::getInstanceRequire("dia"),
  Entity::getInstanceRequire("domicilio"),
  Entity::getInstanceRequire("horario"),
  Entity::getInstanceRequire("modalidad"),
  Entity::getInstanceRequire("persona"),
  Entity::getInstanceRequire("plan"),
  Entity::getInstanceRequire("sede"),
  Entity::getInstanceRequire("tipo_sede"),
  Entity::getInstanceRequire("toma"),
);

  Entity::setStructure($structure);

