<?php

require_once("../config/config.php");
require_once("class/Container.php");
<<<<<<< HEAD
require_once("class/model/Entity.php");
=======
require_once("class/model/Render.php");
>>>>>>> 5ea467f2b94664a5d8947555b0cd4ce3d7d35476

$render = new Render();
$container = new Container();
$a = $container->getEntity("alumno");
echo $a->getName();
$b = $container->getEntity("persona");
echo $b->getName();

//print_r($a);
//$a = $container->getStructure();

<<<<<<< HEAD
=======
echo "<pre>";
print_r($container->getDb()->all("comision", $render));
>>>>>>> 5ea467f2b94664a5d8947555b0cd4ce3d7d35476
