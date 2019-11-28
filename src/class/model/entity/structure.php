<?php

require_once("class/model/Entity.php");

$structure = array (
  Entity::getInstanceRequire("cargo"),
  Entity::getInstanceRequire("centro_educativo"),
  Entity::getInstanceRequire("designacion"),
  Entity::getInstanceRequire("domicilio"),
  Entity::getInstanceRequire("persona"),
  Entity::getInstanceRequire("sede"),
  Entity::getInstanceRequire("tipo_sede"),
);

  Entity::setStructure($structure);

