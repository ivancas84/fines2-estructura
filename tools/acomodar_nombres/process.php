<? 
/**
 * CONSIDERACIONES
 * no se procesaran las personas sin dni ya que no puede asignarse la trayectoria
 * si existe mas de una inscripcion por alumno solo se procesara la primera, ignorando la segunda
 * si se vuelve a cargar el mismo archivo (respetando los parámetros), se actualizaran los datos. Con esto se da la posibilidad de correjir los errores en el csv y volverlo a cargar.
 */
require_once("../../config/config.php"); 
require_once("class/Container.php");
set_time_limit ( 0 );


$source = explode("\n", $_REQUEST["source"]);

$r = [];
foreach($source as $s){
  $s = preg_replace("/\t+/", " ", $s);
  $s = preg_replace( "/\s+/", " ", $s);

  if((stripos($s, "distrito") !== false)
  || (stripos($s, "en previas") !== false)
  || (stripos($s, "promovi") !== false)
  || (stripos($s, "química") !== false)
    || (stripos($s, "asignatura") !== false)
    || (stripos($s, "profesor") !== false)
    || (stripos($s, "región") !== false)
    || (stripos($s, "cuatrimestre") !== false)
    || (stripos($s, "de adultos") !== false)
    || (stripos($s, "cultura") !== false)
    || (stripos($s, "provincia") !== false)
    || (stripos($s, "buenos aires") !== false)
    || (stripos($s, "lunes") !== false)
    || (stripos($s, "martes") !== false)
    || (stripos($s, "miercoles") !== false)
    || (stripos($s, "la plata") !== false)
    || (stripos($s, "miércoles") !== false)
    || (stripos($s, "jueves") !== false)
    || (stripos($s, "horario") !== false)
    || (stripos($s, "alumno") !== false)
    || (stripos($s, "desarrollo") !== false)
    || (stripos($s, "dni") !== false)
    || (stripos($s, "nota cuatr") !== false)
    || (stripos($s, "cantidad") !== false)
    || (stripos($s, "nota asist") !== false)
    || (stripos($s, "en crec") !== false)
    || (stripos($s, "bachiller") !== false)
    || (stripos($s, "calificacion") !== false)
    || (stripos($s, "general de") !== false)
    || (stripos($s, "planilla de ca") !== false)
    || (stripos($s, "del docente") !== false)
    || (stripos($s, "viernes") !== false)
    || (stripos($s, "en letras") !== false)
    || (stripos($s, "apellido") !== false))   continue;
  $s = preg_replace('/\d+/u', '', $s);
  $s = str_ireplace( ['!','+','#', '¿', '•', '=', 'º', '¡', '~', '-', '_', '·','°', '%', '.', ')','(', ':', '\\' ,'/', '"', ',' , ';', '<', '>' ], ' ', $s);
  
  $s = str_ireplace("ausente", "", $s);
  $s = str_ireplace("uno", "", $s);
  $s = str_ireplace("dos", "", $s);
  $s = str_ireplace("tres", "", $s);
  $s = str_ireplace("cuatro", "", $s);
  $s = str_ireplace("cinco", "", $s);
  $s = str_ireplace("seis", "", $s);
  $s = str_ireplace("siete", "", $s);
  $s = str_ireplace("ocho", "", $s);
  $s = str_ireplace("nueve", "", $s);
  $s = str_ireplace("diez", "", $s);
  $s = preg_replace("/\t+/", " ", $s);
  $s = preg_replace( "/\s+/", " ", $s);
  $s_ = explode(" ", $s);
  $s__ = [];
  foreach($s_ as $word) {
    if(strlen($word) > 1) array_push($s__, $word);
  }
  if(count($s__) <= 1) continue;

  $s= implode(" ", $s__);
  $s = trim($s);

  if(empty($s) || strlen($s) < 3) continue;
  array_push($r, $s);
}

$r = array_unique($r);
sort($r);
foreach($r as $v){
  echo $v . "<br>";
}