<?php

set_time_limit(0);  
setlocale(LC_ALL,"es_AR");

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
require_once("function/pdf/signature.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php');


class LibroMatrizPdf extends BaseController{
 /**
   * Formulario para cargar calificaciones
   * ./script/calificacion_form
   */


 

  public function main(){

    //$qrcode = qr($_GET["url"]);
    //$signature = array_key_exists("firma", $_GET)? settypebool($_GET["firma"]) : true;
    

    $this->alumno = $this->container->db()->get("alumno",$_GET["id"]);
    if(empty($this->alumno["plan"])) throw new Exception("El alumno no tiene plan definido");
    if(empty($this->alumno["anio_ingreso"])) throw new Exception("El alumno no tiene año de Ingreso definido");

    $model_tools = $this->container->controller_("model_tools");

    $anio = intval($this->alumno["anio_ingreso"]);

    $calificaciones = $model_tools->calificacionesAlumnoPlanAnio($this->alumno["id"], $this->alumno["plan"], $this->alumno["anio_ingreso"]);
    if(empty($calificaciones) || (count($calificaciones) != (40-($anio*10)))) throw new Exception("La cantidad de calificaciones obtenida para el plan y el año no coincide");


    $v = $this->container->tools("alumno")->value($this->alumno);

    $date = new SpanishDateTime();
    $mpdf = new \Mpdf\Mpdf();

    $fechaNacimiento = new SpanishDateTime($v["persona"]->_get("fecha_nacimiento","Y-m-d"));
    $calificaciones = array_group_value($calificaciones, "dis_pla_anio");
    
    $c = '
<div class="title">
  Libro <span class="data">' . $this->ev($v["alumno"]->_get("libro")) . '</span>,
  Folio<span class="data">' . $this->ev($v["alumno"]->_get("folio")) .'</span>
</div>
<div class="content">
  <p>El alumno/a <span class="data">' . $this->ev($v["persona"]->_get("apellidos", "X") . ' ' 
. $v["persona"]->_get("nombres","Xx Yy")) . '</span> DNI Nº 
<span class="data">' . $this->ev($v["persona"]->_get("numero_documento","Xx Yy")) . '</span>
nacido en <span class="data">' . $this->ev($v["persona"]->_get("lugar_nacimiento", "Xx Yy")) . '</span>,
el día <span class="data">' . $this->ev($v["persona"]->_get("fecha_nacimiento","d")) . '</span>
de <span class="data">' . $this->ev($v["persona"]->_get("fecha_nacimiento","F")) . '</span>
de <span class="data">' . $this->ev($v["persona"]->_get("fecha_nacimiento","Y")) . '</span>,
ingreso con certificado de <span class="data">' . $this->ev($v["alumno"]->_get("establecimiento_inscripcion","Y")) . '</span>,
al plan <span class="data">'. $this->ev('Programa Fines 2 Trayecto Secundario') . '</span>,
orientacion <span class="data">' . $this->ev($v["plan"]->_get("orientacion")) . '</span>,
resolución <span class="data">' . $this->ev($v["plan"]->_get("resolucion")) . '</span>.
  </p>

</div>
';


    $formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);


  
    foreach($calificaciones as $anio => $cals){
      $c .= '<table class="simple-table">';
      $c .= '<tr>';
      $c .= '<th rowspan="2">' . $anio . 'º AÑO</th><th colspan="2">Calificación</th><th rowspan="2">Fecha</th>';
      $c .= '</tr>';
      $c .= '<tr>';
      $c .= '<th>Números</th><th>Letras</th>';
      $c .= '</tr>';

      foreach($cals as $d){
        if((intval($d["nota_final"]) < 7) && (intval($d["crec"]) >= 4)){
          $calificacionLetras = $formatterES->format($d["crec"]) . " CREC";
          $calificacion = round($d["crec"],0) . " C";
        } else {
          $calificacionLetras = $formatterES->format($d["nota_final"]);
          $calificacion = round($d["nota_final"],0);
        }


        $c .= '<tr>';
        $c .= '<td>' . $d["dis_asi_nombre"] . '</td><td>' . $calificacion . '</td>><td>' . $calificacionLetras . '</td><td></td>';
        $c .= '</tr>';
    
      }
      $c .= "</tr></table><br/>";

    }


    $c.= '<div class="content"><p>Observaciones: <span class="data">' . $this->ev($v["alumno"]->_get("comentarios"), 0) . '</span>';
    $c.= '</p>
    <br />
    <br />  <br />
    <br />
    </div>
    <div class="content">
      <div style="float: left; width: 10%">&nbsp;</div>
      <div style="float: left; width: 20%">Fecha</div>
      <div style="float: left; width: 50%">&nbsp;</div>
      <div style="float: left; width: 20%">Firma</div>
    </div>
    <br />
   ';
    
    $html = htmlToPdfIndex($c); 
    


    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetProtection(["print"]);

    $mpdf->WriteHTML($html);
    $mpdf->Output("constancia.pdf", 'I');
    //echo $html;
  }


   /**
   * Imprime el texto enviado como parametro.
   * Si es vacio imprime espacios en blanco para que el usuario complete.
   */
  protected function ev($imprimir, $long = 20){
    $i = trim($imprimir);
    if(!empty($i) && $i != UNDEFINED) return "&nbsp;&nbsp;&nbsp;".$i."&nbsp;&nbsp;&nbsp;";

    $r = "";
    for($j = 0; $j < $long; $j++) $r .= "&nbsp;";
    return $r;
  }
}