<?php

require_once("class/Container.php");

$container = new Container();
$structure = array (
  $container->getEntity("asignatura"),
  $container->getEntity("calendario"),
  $container->getEntity("cargo"),
  $container->getEntity("centro_educativo"),
  $container->getEntity("comision"),
  $container->getEntity("contralor"),
  $container->getEntity("curso"),
  $container->getEntity("designacion"),
  $container->getEntity("detalle_persona"),
  $container->getEntity("dia"),
  $container->getEntity("distribucion_horaria"),
  $container->getEntity("domicilio"),
  $container->getEntity("email"),
  $container->getEntity("file"),
  $container->getEntity("horario"),
  $container->getEntity("modalidad"),
  $container->getEntity("persona"),
  $container->getEntity("plan"),
  $container->getEntity("planificacion"),
  $container->getEntity("planilla_docente"),
  $container->getEntity("sede"),
  $container->getEntity("telefono"),
  $container->getEntity("tipo_sede"),
  $container->getEntity("toma"),
);

  Entity::setStructure($structure);

