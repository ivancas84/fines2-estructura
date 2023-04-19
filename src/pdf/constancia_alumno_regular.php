<?php

set_time_limit(0);  
require_once("controller/base.php");
require_once("function/array_group_value.php"); 
require_once("function/array_combine_key2.php"); 
require_once("Container.php");
require_once("tools/SpanishDateTime.php");
require_once("function/array_group_value.php");
require_once("function/settypebool.php");
require_once("function/qr.php");
require_once("function/pdf/index.php");
require_once("function/pdf/header.php");
require_once("function/pdf/extiende-presente.php");
require_once("function/pdf/signature.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php');

class ConstanciaAlumnoRegularPdf extends BaseController{
 /**
   * Generar pdf constancia de alumno regular
   */
  public function main(){

    $qrcode = qr($_GET["url"]);
    $signature = array_key_exists("firma", $_GET)? settypebool($_GET["firma"]) : true;

    $this->alumno = $this->container->query("alumno")->param("id",$_GET["id"])->fields()->one();
    
    $anio = intval($this->alumno["anio_ingreso"]);

    $cantidades = $this->container->controller("calificaciones","alumno")->aprobadas_por_anio($this->alumno["id"], $this->alumno["plan"]);
    $notes = $_GET["observaciones"];

    array_multisort(
      array_column($cantidades, 'anio'), 
      SORT_ASC, 
      $cantidades
    );

    foreach($cantidades as $q){
      if(intval($q["anio"]) != $anio) throw new Exception("Existe un error al obtener las asignaturas aprobadas, falta un año");
      if($q["cantidad"] < 10) $completo = false;
      $anio++;
    }

    switch($anio-1){
      case 1:
        $anioPrint = "PRIMERO";
      break;
      case 2:
        $anioPrint = "SEGUNDO";
      break;
      case 3:
        $anioPrint = "TERCER";
      break;
      default:
        $anioPrint = "PRIMERO";
    }


    $v = $this->container->tools("alumno")->value($this->alumno);
    $date = new SpanishDateTime();
    $mpdf = new \Mpdf\Mpdf();

    $c = htmlToPdfHeader($qrcode);
    $c .= '
<div class="title">
  CONSTANCIA DE ALUMNO REGULAR
</div>
<div class="content">
  <p>La Dirección de la Escuela de Educación CENS Nº 462 de La Plata, 
hace constar por la presente que <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("apellidos", "X") . ' ' . $v["persona"]->_get("nombres","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span> DNI Nº <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("numero_documento","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span>
es alumno/a regular de <span class="data">&nbsp;&nbsp;&nbsp;' . $anioPrint . '&nbsp;&nbsp;&nbsp;</span> año <span class="data">&nbsp;&nbsp;&nbsp;Programa Fines 2 Trayecto Secundario&nbsp;&nbsp;&nbsp;</span>
con orientación en <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("orientacion") . '&nbsp;&nbsp;&nbsp;</span> resolución <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("resolucion") . '&nbsp;&nbsp;&nbsp;</span>
  </p>

';
    if(!empty($notes)) $c .= '<p><span class="data">&nbsp;&nbsp;&nbsp;'. $notes . '&nbsp;&nbsp;&nbsp;</span></p>';
    $c .= htmlToPdfExtiendePresente($signature);
    $c .= htmlToPdfSignature($signature);
    $html = htmlToPdfIndex($c); 
    $c .= '</div>';


  
    // echo $html;
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetProtection(["print"]);

    $mpdf->WriteHTML($html);

    $mpdf->Output("constancia_alumno_regular_" . $v["persona"]->_get("numero_documento") . ".pdf", 'I');
  }
}