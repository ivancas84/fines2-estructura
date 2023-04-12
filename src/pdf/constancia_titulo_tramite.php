<?php

set_time_limit(0);  
require_once("controller/base.php");
require_once("function/array_group_value.php"); 
require_once("function/array_combine_key2.php"); 
require_once("function/array_combine_key.php"); 

require_once("Container.php");
require_once("tools/SpanishDateTime.php");
require_once("function/array_group_value.php");
require_once("function/settypebool.php");
require_once("function/qr.php");
require_once("function/pdf/index.php");
require_once("function/pdf/header.php");
require_once("function/pdf/signature.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php');


class ConstanciaTituloTramitePdf extends BaseController{
 /**
   * Formulario para cargar calificaciones
   * ./script/calificacion_form
   */

  public function main(){

    $qrcode = qr($_GET["url"]);
    $signature = array_key_exists("firma", $_GET)? settypebool($_GET["firma"]) : true;
    

    $this->alumno = $this->container->query("alumno")->param("id",$_GET["id"])->fields()->one();
    if(empty($this->alumno["plan"])) throw new Exception("El alumno no tiene plan definido");

    

    $model_tools = $this->container->controller_("model_tools");

    $cantidades = $this->container->controller("calificaciones","alumno")->aprobadas_por_anio($this->alumno["id"], $this->alumno["plan"]);
    array_multisort(
      array_column($cantidades, 'anio'), 
      SORT_ASC, 
      $cantidades
    );

    if(empty($cantidades)) throw new Exception("No tiene cargadas asignaturas aprobadas");

    $completo = true;
    $anio_ingreso = intval($this->alumno["anio_ingreso"]);

    $cantidades_anio = array_combine_key($cantidades, "anio");

    for($i = 1; $i <= 3; $i++){
      $anio = $i;
      if($anio_ingreso > $i) continue;
      if(!array_key_exists($i, $cantidades_anio)) throw new Exception("Existe un error al obtener las asignaturas aprobadas, falta un año");
      if($cantidades_anio[$i]["cantidad"] < 10) $completo = false;
    }
    
    $completoPrint = ($completo)? "COMPLETO":"INCOMPLETO";
    switch($anio){
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
        throw new Exception("El año definido es incorrecto");
    }

    $v = $this->container->tools("alumno")->value($this->alumno);
    $date = new SpanishDateTime();
    $mpdf = new \Mpdf\Mpdf();

    $c = htmlToPdfHeader($qrcode);
    $c .= '
<div class="title">
  CONSTANCIA DE CERTIFICADO DE ESTUDIO EN TRÁMITE
</div>
<div class="content">
  <p>La Dirección de la Escuela de Educación CENS Nº 462 de La Plata, 
hace constar por la presente que <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("apellidos", "X") . ' ' 
. $v["persona"]->_get("nombres","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span> DNI Nº 
<span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("numero_documento","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span>
tiene en trámite un CERTIFICADO ANALÍTICO DE ESTUDIOS <span class="data">&nbsp;&nbsp;&nbsp;'. $completoPrint . '&nbsp;&nbsp;&nbsp;</span>
de <span class="data">&nbsp;&nbsp;&nbsp;' . $anioPrint . '&nbsp;&nbsp;&nbsp;</span> año 
<span class="data">&nbsp;&nbsp;&nbsp;Programa Fines 2 Trayecto Secundario&nbsp;&nbsp;&nbsp;</span>
con orientación en <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("orientacion") . '&nbsp;&nbsp;&nbsp;</span> 
resolución <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("resolucion") . '&nbsp;&nbsp;&nbsp;</span>, 
adeudando: <span class="data">&nbsp;&nbsp;&nbsp;Ninguna materia&nbsp;&nbsp;&nbsp;</span></p>
<p>A pedido del/de la interesado/a y al sólo efecto de ser presentado ante las autoridades que se lo exijan, 
se extiene la presente en La Plata a los <span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("d") . '&nbsp;&nbsp;&nbsp;</span>
del mes de <span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("F") . '&nbsp;&nbsp;&nbsp;</span> 
de <span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("Y") . '&nbsp;&nbsp;&nbsp;</span>.</p>
</div>
';
    $c .= htmlToPdfSignature($signature);
    $html = htmlToPdfIndex($c); 


    // echo $html;
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetProtection(["print"]);

    $mpdf->WriteHTML($html);
    $mpdf->Output("constancia.pdf", 'I');
  }
}