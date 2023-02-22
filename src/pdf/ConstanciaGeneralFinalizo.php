<?php

set_time_limit(0);  
require_once("controller/base.php");
require_once("function/array_group_value.php"); 
require_once("function/array_combine_key2.php"); 
require_once("Container.php");
require_once("tools/SpanishDateTime.php");
require_once("function/array_group_value.php");
require_once("function/suma-disposiciones-por-anio.php");
require_once("function/anios-restantes.php");
require_once("function/traducir-anios.php");

require_once("function/settypebool.php");
require_once("function/qr.php");
require_once("function/pdf/index.php");
require_once("function/pdf/header.php");
require_once("function/pdf/extiende-presente.php");
require_once("function/pdf/signature.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php');





class ConstanciaGeneralFinalizoPdf extends BaseController{
 /**
   * Formulario para cargar calificaciones
   * ./script/calificacion_form
   */

  public function main(){
    
    $container = new Container;
    
    
    $alumno = $this->container->query("alumno")->param("id",$_GET["id"])->fields()->one();
    if(empty($alumno["plan"]) || empty($alumno["anio_ingreso"])) throw new Exception("El alumno no tiene plan o año definido");
    $modelTools = $this->container->controller_("model_tools");
    $v = $this->container->tools("alumno")->value($alumno);
    
    $calificaciones = $modelTools->calificacionesAprobadasAlumnoPlan($alumno["id"], $alumno["plan"]);
    $disposiciones = $modelTools->disposicionesPlanAnio($alumno["plan"], $alumno["anio_ingreso"]);
    $disposicionesRestantes = $modelTools->disposicionesRestantes($calificaciones, $disposiciones);
    $anios = sumaDisposicionesPorAnio($disposicionesRestantes);
    $aniosCursados = traducirAnios($anios, $alumno["anio_ingreso"]);
    $aniosRestantes = aniosRestantes($aniosCursados);
    $mpdf = new \Mpdf\Mpdf();
    $qrcode = qr($_GET["url"]);
    $signature = array_key_exists("firma", $_GET)? settypebool($_GET["firma"]) : true;
    $notes = $_GET["observaciones"];
    
    
    $c = htmlToPdfHeader($qrcode);
    $c .= '
    
    <div class="title">
    CONSTANCIA GENERAL
    </div>
  ';  
    
    $c .= '<div class="content">';
    $c .= '<p>La Dirección del CENS 462 distrito La Plata, deja constancia que 
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
        if(key_exists($d["planificacion-anio"], $aniosRestantes)) continue; 
        $c .= "<li>".$d["asignatura-nombre"] . " (" . $d["planificacion-anio"]."º año)</li>";
      }
    
      foreach($aniosRestantes as $a){
        $c .= "<li>Todas las asignaturas de ". $a . "</li>";
      }
    }
    
    
    $c .= '</ul>';
 
    if(!$v["alumno"]->_get("tiene_certificado") || !$v["alumno"]->_get("previas_completas")){
      $c .= '<p><span class="data">&nbsp;&nbsp;&nbsp; Documentación adeudada: ';
      if(!$v["alumno"]->_get("tiene_certificado")) $c .= "Certificado de estudios previos a fines. ";
      if(!$v["alumno"]->_get("previas_completas")) $c .= "Constancia de asignaturas previas rendidas en programa \"fines deudores de materias\". ";
      $c .= '&nbsp;&nbsp;&nbsp;</span></p>';
    }
 
    if(!empty($notes)) $c .= '<p><span class="data">&nbsp;&nbsp;&nbsp;'. $notes . '&nbsp;&nbsp;&nbsp;</span></p>';

    $c .= htmlToPdfExtiendePresente($signature);
    $c .= htmlToPdfSignature($signature);
    $html = htmlToPdfIndex($c);
    $c .= '</div>';
    
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetProtection(["print"]);
    
    $mpdf->WriteHTML($html);
    $mpdf->Output("constancia.pdf", 'I');

 }
}