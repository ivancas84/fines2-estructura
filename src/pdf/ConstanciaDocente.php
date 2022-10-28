<?php

set_time_limit(0);  
require_once("class/controller/Base.php");
require_once("function/filter_get.php");
require_once("function/array_group_value.php"); 
require_once("function/array_combine_key2.php"); 
require_once("class/Container.php");
require_once("class/tools/SpanishDateTime.php");
require_once("function/array_group_value.php");
require_once("function/settypebool.php");
require_once("function/qr.php");
require_once("function/ordinal.php");
require_once("function/pdf/index.php");
require_once("function/pdf/header.php");
require_once("function/pdf/signature.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php');





class ConstanciaDocentePdf extends BaseController{
 /**
   * Generar pdf constancia de docente
   */
  public function main(){

    $qrcode = qr(filter_get("url"));
    $signature = array_key_exists("firma", $_GET)? settypebool(filter_get("firma")) : true;
    $id = filter_get("id");
    
    $v = $this->container->tools("toma")->value(
      $this->container->getDb()->get("toma",$id)
    );

    $modelTools = $this->container->getController("model_tools");

    $date = new SpanishDateTime();

    $fechaToma = $v["toma"]->_get("fecha_toma");
    $fechaToma4 = clone $fechaToma;
    $fechaToma4->modify("+ 4 month");  
    $calendarioFin = $v["calendario"]->_get("fin");
    $fechaFin = ($fechaToma4 < $calendarioFin) ? $fechaToma4 : $calendarioFin;

    $mpdf = new \Mpdf\Mpdf();

    $c = htmlToPdfHeader($qrcode);
    $c .= '
<div class="title">
  CONSTANCIA GENERAL
</div>
<div class="content">
  <p>La Dirección de la Escuela de Educación CENS Nº 462 de La Plata, 
hace constar por la presente que <span class="data">&nbsp;&nbsp;&nbsp;' . $v["docente"]->_get("apellidos", "X") . ' ' . $v["docente"]->_get("nombres","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span> DNI Nº <span class="data">&nbsp;&nbsp;&nbsp;' . $v["docente"]->_get("numero_documento","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span>
es docente de la asignatura <span class="data">&nbsp;&nbsp;&nbsp;' . $v["asignatura"]->_get("nombre") . '&nbsp;&nbsp;&nbsp;</span> 
tramo <span class="data">&nbsp;&nbsp;&nbsp;' . $v["planificacion"]->_get("anio") . '°' . $v["planificacion"]->_get("semestre") . 'C&nbsp;&nbsp;&nbsp;</span>
correspondiente a <span class="data">&nbsp;&nbsp;&nbsp;Programa Fines 2 Trayecto Secundario&nbsp;&nbsp;&nbsp;</span>
con orientación en <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("orientacion") . '&nbsp;&nbsp;&nbsp;</span> resolución <span class="data">&nbsp;&nbsp;&nbsp;' . $v["plan"]->_get("resolucion") . '&nbsp;&nbsp;&nbsp;</span>.
El período de cursada abarca desde <span class="data">&nbsp;&nbsp;&nbsp;' . $v["toma"]->_get("fecha_toma", "d/m/Y") . '&nbsp;&nbsp;&nbsp;</span> hasta <span class="data">&nbsp;&nbsp;&nbsp;' . $fechaFin->format("d/m/Y") . '&nbsp;&nbsp;&nbsp;</span>.


  </p>
  <p>A pedido del/de la interesado/a y al sólo efecto de ser presentado ante las autoridades que se lo exijan, se extiene la presente en La Plata a los <span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("d") . '&nbsp;&nbsp;&nbsp;</span> días
del mes de <span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("F") . '&nbsp;&nbsp;&nbsp;</span> 
de <span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("Y") . '&nbsp;&nbsp;&nbsp;</span>.
  </p>
</div>
';
    $c .= htmlToPdfSignature($signature);
    $html = htmlToPdfIndex($c); 


    // echo $html;
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetProtection(["print"]);

    $mpdf->WriteHTML($html);

    $mpdf->Output("constancia_servicios_" . $v["docente"]->_get("numero_documento") . ".pdf", 'I');
  }
}