<?php

set_time_limit(0);  
require_once("controller/base.php");
require_once("function/ordinal.php"); 
require_once("function/array_group_value.php"); 
require_once("function/array_combine_key.php"); 
require_once("function/array_combine_key2.php"); 

require_once("tools/SpanishDateTime.php");
require_once("function/qr.php");
require_once("function/settypebool.php");
require_once("function/pdf/index.php");
require_once("function/pdf/header.php");
require_once("function/pdf/signature.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php');

class ConstanciaTituloEntregadoPdf extends BaseController{
 /**
   * Formulario para cargar calificaciones
   * ./script/calificacion_form
   */

  public function main(){
    $qrcode = qr($_GET["url"]);

    $signature = array_key_exists("firma", $_GET)? settypebool($_GET["firma"]) : true;

    $this->alumno = $this->container->db()->get("alumno",$_GET["id"]);
    if(empty($this->alumno["plan"])) throw new Exception("El alumno no tiene plan definido");

    $model_tools = $this->container->controller_("model_tools");


    $calificaciones = $model_tools->calificacionesAprobadasAlumnoPlan($this->alumno["id"], $this->alumno["plan"]);
    $disposiciones = $model_tools->disposicionesPlanAnio($this->alumno["plan"], $this->alumno["anio_ingreso"]);
    $disposicionesRestantes = $model_tools->disposicionesRestantesAnio($calificaciones, $disposiciones);

    $cantidades = array_combine_key(
      $this->container-controller("calificaciones","alumno")->aprobadas_por_anio($this->alumno["id"], $this->alumno["plan"]),
      "anio"
    );
    if(empty($cantidades)) throw new Exception("No tiene cargadas asignaturas aprobadas");

    $calificaciones = array_group_value($calificaciones, "dis_pla_anio");

    $aniosCursadosNumero = array_keys($cantidades);
    $aniosCursados = [];
    for($i = intval($this->alumno["anio_ingreso"]); $i <= 3; $i++) {
      if(in_array($i, $aniosCursadosNumero))
        array_push($aniosCursados, ordinal($i));
    }


    $v = $this->container->tools("alumno")->value($this->alumno);
    $date = new SpanishDateTime();
    $mpdf = new \Mpdf\Mpdf();

    $ningunaMateria = (count($disposicionesRestantes)) ? "" : '<span class="data">&nbsp;&nbsp;&nbsp;Ninguna Materia&nbsp;&nbsp;&nbsp;</span>';

    $c .= '

<div class="content">
  <p>Libro _____ Folio _____ <br>,
  Alumna/o <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("apellidos", "X") . ' ' 
. $v["persona"]->_get("nombres","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span> DNI Nº 
<span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("numero_documento") . '&nbsp;&nbsp;&nbsp;</span>
nacido en <span class="data">&nbsp;&nbsp;&nbsp;' . implode(", ", $aniosCursados) . '&nbsp;&nbsp;&nbsp;</span> ha cursado los años <span class="data">&nbsp;&nbsp;&nbsp;' . implode(", ", $aniosCursados) . '&nbsp;&nbsp;&nbsp;</span>
del <span class="data">&nbsp;&nbsp;&nbsp;Programa Fines 2 Trayecto Secundario&nbsp;&nbsp;&nbsp;</span>
con orientación en <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("orientacion") . '&nbsp;&nbsp;&nbsp;</span> 
resolución <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("resolucion") . '&nbsp;&nbsp;&nbsp;</span>, 
adeudando las siguientes materias:' . $ningunaMateria . '</p>
';

if(count($disposicionesRestantes)){
  $c .= "<ul>";

  foreach($disposicionesRestantes as $anio => $d_){

    if(!in_array($anio, $aniosCursadosNumero)) {
      $c .= "<li>Todas las asignaturas de " . ordinal($anio) . "</li>";
      continue;
    }
    if(count($d_)){
      
      foreach($d_ as $d) {
      //if(key_exists($d["pla_anio"], $aniosRestantes)) continue; 
        $c .= "<li>".$d["asi_nombre"] . " (" . $d["pla_anio"]."º año)</li>";
      }

    }

  }

  $c .= "</ul>";

} 

if(count($calificaciones)){

  $c .= "<p>A continuación se listan las asignaturas aprobadas:</p>";

  $c .= '<table class="simple-table">';

  $c .= '<tr>';

  $formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);

  foreach($calificaciones as $anio => $d_){
    $c .= '<th>' . $anio . 'º AÑO</th>';

  }

  $c .= '</tr><tr>';

  foreach($calificaciones as $anio => $d_){
      

      $c .= "<td><ul>";

      foreach($d_ as $d){
        $calificacion = ($d["nota_final"] >= 4) ? intval($d["nota_final"]) . " (". $formatterES->format($d["nota_final"]) .")" : intval($d["crec"]) . " (". $formatterES->format($d["crec"]) .") CREC"; 
        $c .= "<li>".$d["dis_asi_nombre"] . ": " . $calificacion . "</li>";
      }

      $c .= "</ul></td>";

  }

  $c .= "</tr></table>";

}

  
$date = new SpanishDateTime();
    
$c .='<p>Se extiende la presente a pedido del interesado en La Plata el día 
<span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("d") . ' de ' . $date->format("F") . ' de ' . $date->format("Y"). '&nbsp;&nbsp;&nbsp;</span> para ser presentado ante <span class="data">&nbsp;&nbsp;&nbsp;quien corresponda&nbsp;&nbsp;&nbsp;</span>.</p>
</div>
';

    $c .= htmlToPdfSignature($signature);
    
    $html = htmlToPdfIndex($c); 

    // echo $html;
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetProtection(["print"]);

    $mpdf->WriteHTML($html);
    $mpdf->Output("constancia_general_" . $v["persona"]->_get("numero_documento") . ".pdf", 'I');
  }
}