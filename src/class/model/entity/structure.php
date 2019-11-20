<?php

require_once("class/model/Entity.php");

$structure = array (
  Entity::getInstanceRequire("centro_educativo"),
  Entity::getInstanceRequire("domicilio"),
  Entity::getInstanceRequire("sede"),
  Entity::getInstanceRequire("tipo_sede"),
);

  Entity::setStructure($structure);

