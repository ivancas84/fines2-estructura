<?
require_once("../config/config.php");

require_once("Container.php");

$container = new Container();

echo "<pre>";
print_r($container->query("comision")->size(100)->fields(["planificacion-tramo.max"])->sql());
// print_r(get_defined_constants(true));