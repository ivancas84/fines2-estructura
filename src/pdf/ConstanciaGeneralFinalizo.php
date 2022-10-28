<?php

set_time_limit(0);  
require_once("controller/Base.php");
require_once("function/array_group_value.php"); 
require_once("function/array_combine_key2.php"); 
require_once("Container.php");
require_once("tools/SpanishDateTime.php");
require_once("function/array_group_value.php");
require_once("function/settypebool.php");
require_once("function/qr.php");
require_once("function/pdf/index.php");
require_once("function/pdf/header.php");
require_once("function/pdf/signature.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php');





class ConstanciaGeneralFinalizoPdf extends BaseController{
 /**
   * Formulario para cargar calificaciones
   * ./script/calificacion_form
   */

  public function main(){
    
    $container = new Container;
    
    $alumnoTools = $container->controller_("alumno_tools");
    
    $alumnoTools->init($_GET["id"]);
    $v = $alumnoTools->getValue();
    
    $calificaciones = $alumnoTools->getCalificacionesAprobadas();
    
    $disposiciones = $alumnoTools->getDisposiciones();
    
    $disposicionesRestantes = $alumnoTools->disposicionesRestantes($calificaciones, $disposiciones);
    $anios = $alumnoTools->sumaDisposicionesPorAnio($disposicionesRestantes);
    $aniosCursados = $alumnoTools->traducirAnios($anios);
    $aniosRestantes = $alumnoTools->aniosRestantes($aniosCursados);
    $mpdf = new \Mpdf\Mpdf();
    $qrcode = qr($_GET["url"]);
    $signature = array_key_exists("firma", $_GET)? settypebool($_GET["firma"]) : true;
    $notes = $_GET["observaciones"];
    
    
    $c = htmlToPdfHeader($qrcode);
    $c .= '
    
    <div class="title">
    CONSTANCIA GENERAL
    </div>
    
    
    <div class="content">
    <p>La Dirección del CENS 462 distrito La Plata, deja constancia que 
    <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("apellidos", "X") . ' ' . $v["persona"]->_get("nombres","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span>
    DNI 
    <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("numero_documento","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span>
    ha finalizado sus estudios del Programa Fines 2 Trayecto Secundario orientación 
    <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("orientacion") . '&nbsp;&nbsp;&nbsp;</span> 
    resolución <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("resolucion") . '&nbsp;&nbsp;&nbsp;</span>, 
    ';
    
    if(empty($disposicionesRestantes)) {
    $c .= " sin adeudar materias.</p>
    ";
    } else {
    
      $c .= "  adeudando las siguientes materias:</p>
    <ul>
    ";
    
    
    
      foreach($disposicionesRestantes as $d){
        if(key_exists($d["pla_anio"], $aniosRestantes)) continue; 
        $c .= "<li>".$d["asi_nombre"] . " (" . $d["pla_anio"]."º año)</li>";
      }
    
      foreach($aniosRestantes as $a){
        $c .= "<li>Todas las asignaturas de ". $a . "</li>";
      }
    }
    
    $date = new SpanishDateTime();
    
    $c .= '</ul>';

    if(!empty($notes)) $c .= '<p><span class="data">&nbsp;&nbsp;&nbsp;'. $notes . '&nbsp;&nbsp;&nbsp;</span></p>';

    $c .= '<p>Se extiende la presente a pedido del interesado en La Plata el día 
    <span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("d") . ' de ' . $date->format("F") . ' de ' . $date->format("Y"). '&nbsp;&nbsp;&nbsp;</span> para ser presentado ante <span class="data">&nbsp;&nbsp;&nbsp;quien corresponda&nbsp;&nbsp;&nbsp;</span>.</p>
    </div>
    ';
    $c .= htmlToPdfSignature($signature);
    $html = htmlToPdfIndex($c); 
    
    
    
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetProtection(["print"]);
    
    $mpdf->WriteHTML($html);
    $mpdf->Output("constancia.pdf", 'I');

 }
}