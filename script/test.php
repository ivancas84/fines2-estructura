<?php

require_once("../config/config.php");
require_once("class/Container.php");
require_once("class/model/Render.php");
require_once("function/get_entity_relations.php");


$container = new Container();
echo $container->getCondition("asignatura")->_("label_search","=~",4);
/*$rows = $container->getDb()->getAll("comision", ["5f73a0dd951c8","5e501982a1ce3"]);


$rel = $container->getRel("comision");
foreach($rows as &$row) {
  echo "voy a generar json";
  $row = $rel->json($row);
}

echo "<pre>";
print_r($rows);
*/