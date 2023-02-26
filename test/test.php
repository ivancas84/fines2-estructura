<?
require_once("../config/config.php");

require_once("Container.php");

$container = new Container();

echo "<pre>";
print_r(
    $container->controller("referentes","sede")
    ->nombre_telefono(["614230b21033d", "61eba92698ae6"])
);