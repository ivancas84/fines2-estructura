<? 
/**
 * CONSIDERACIONES
 * no se procesaran las personas sin dni ya que no puede asignarse la trayectoria
 * si existe mas de una inscripcion por alumno solo se procesara la primera, ignorando la segunda
 * si se vuelve a cargar el mismo archivo (respetando los parámetros), se actualizaran los datos. Con esto se da la posibilidad de correjir los errores en el csv y volverlo a cargar.
 */
require_once("../../config/config.php"); 
require_once("Container.php");
set_time_limit ( 0 );

$container = new Container();
$import = $container->getImport("control_duplicados");
$import->source = $_REQUEST["source"]; //informacion a procesar
$import->define();
$import->identify();
$import->summary();
