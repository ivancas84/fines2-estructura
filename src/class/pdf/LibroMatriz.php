<?php

set_time_limit(0);  
setlocale(LC_ALL,"es_AR");

require_once("class/controller/Base.php");
require_once("function/array_group_value.php"); 
require_once("function/array_combine_key2.php"); 
require_once("class/Container.php");
require_once("class/tools/SpanishDateTime.php");
require_once("function/array_group_value.php");
require_once("function/settypebool.php");
require_once("function/qr.php");
require_once("function/pdf/index.php");
require_once("function/pdf/header.php");
require_once("function/pdf/signature.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php');


class LibroMatrizPdf extends BaseController{
 /**
   * Formulario para cargar calificaciones
   * ./script/calificacion_form
   */

  protected function ev($imprimir){
    $i = trim($imprimir);
    return (empty($i) || $i == UNDEFINED) ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" : $i;
  }

  public function main(){

    //$qrcode = qr($_GET["url"]);
    //$signature = array_key_exists("firma", $_GET)? settypebool($_GET["firma"]) : true;
    

    $this->alumno = $this->container->getDb()->get("alumno",$_GET["id"]);
    if(empty($this->alumno["plan"])) throw new Exception("El alumno no tiene plan definido");
    if(empty($this->alumno["anio_ingreso"])) throw new Exception("El alumno no tiene año de Ingreso definido");

    $modelTools = $this->container->getController("model_tools");

    $anio = intval($this->alumno["anio_ingreso"]);

    $calificaciones = $modelTools->calificacionesAlumnoPlanAnio($this->alumno["id"], $this->alumno["plan"], $this->alumno["anio_ingreso"]);
    if(empty($calificaciones) || (count($calificaciones) != (40-($anio*10)))) throw new Exception("La cantidad de calificaciones obtenida para el plan y el año no coincide");

    $v = $this->container->getRel("alumno")->value($this->alumno);
    $date = new SpanishDateTime();
    $mpdf = new \Mpdf\Mpdf();

    $fechaNacimiento = new SpanishDateTime($v["persona"]->_get("fecha_nacimiento","Y-m-d"));

    $calificaciones = array_group_value($calificaciones, "dis_pla_anio");

    
    $c = '
<div class="title">
  Libro <span class="data">&nbsp;&nbsp;&nbsp; ' . $this->ev($v["persona"]->_get("libro")) . ' &nbsp;&nbsp;&nbsp;</span>,
  Folio<span class="data">&nbsp;&nbsp;&nbsp;' . $this->ev($v["persona"]->_get("folio")) .'&nbsp;&nbsp;&nbsp;</span>
</div>
<div class="content">
  <p>El alumno/a <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("apellidos", "X") . ' ' 
. $v["persona"]->_get("nombres","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span> DNI Nº 
<span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("numero_documento","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span>
nacido en <span class="data">&nbsp;&nbsp;&nbsp;' . $this->ev($v["persona"]->_get("lugar_nacimiento", "Xx Yy")) . '&nbsp;&nbsp;&nbsp;</span>,
el día <span class="data">&nbsp;&nbsp;&nbsp;' . $this->ev($v["persona"]->_get("fecha_nacimiento","d")) . '&nbsp;&nbsp;&nbsp;</span>
de <span class="data">&nbsp;&nbsp;&nbsp;' . $this->ev($v["persona"]->_get("fecha_nacimiento","F")) . '&nbsp;&nbsp;&nbsp;</span>
de <span class="data">&nbsp;&nbsp;&nbsp;' . $this->ev($v["persona"]->_get("fecha_nacimiento","Y")) . '&nbsp;&nbsp;&nbsp;</span>,
ingreso con certificado de <span class="data">&nbsp;&nbsp;&nbsp;' . $this->ev($v["alumno"]->_get("establecimiento_inscripcion","Y")) . '&nbsp;&nbsp;&nbsp;</span>,
al plan <span class="data">&nbsp;&nbsp;&nbsp;Programa Fines 2 Trayecto Secundario&nbsp;&nbsp;&nbsp;</span>,
orientacion <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("orientacion") . '&nbsp;&nbsp;&nbsp;</span>,
resolución <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("resolucion") . '&nbsp;&nbsp;&nbsp;</span>.

</div>
';


  $c .= '<table class="simple-table">';


  $formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);


  $anio_ = $anio;

  while($anio_ <= $anio) {
    $c .= '<tr>';

    foreach($calificaciones as $anio => $d_){
      $c .= '<th>' . $anio . 'º AÑO</th><th>Calificación</th><th>Fecha</th>';

      
    }


  }



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

    $html = htmlToPdfIndex($c); 
    


    // echo $html;
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetProtection(["print"]);

    $mpdf->WriteHTML($html);
    $mpdf->Output("constancia.pdf", 'I');
  }
}