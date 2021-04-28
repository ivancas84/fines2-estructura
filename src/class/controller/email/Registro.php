<?php

require_once("../config/config.php");
require_once("class/Container.php");
require_once("function/email.php");

class RegistroEmail {

  public $entityName;
  public $container;

  public function main($id){

    $mt = $this->container->getController("model_tools");
    $toma = $this->container->getDb()->get("toma",$id);
    $curso = $mt->labelCurso($toma,"cur_");
    $t = $this->container->getRel("toma")->value($toma);

    $subject = "Toma de posesión: " . $curso;

    $body = '
<p>Hola ' . $t["docente"]->_get("nombres", "Xx Yy") . ' ' . $t["docente"]->_get("apellidos", "Xx Yy") . ', usted ha recibido este email porque fue designado/a en la asignatura <strong>' . $curso . '.</strong></p>
<p>Para completar su toma de posesión, necesitamos que responda este email y nos envíe por este medio los siguientes documentos para poder armar su legajo:</p>
<p>
  <ul>
    <li>Foto DNI</li>
    <li>Foto Título habilitante</li>
    <li>Constancia de CUIL</li>
    <li>Comprobante de postulación</li>
    <li>Copia de email con aviso de designación</li>
    <li>Declaración Jurada</li>
  </ul>
</p>
<p>Posteriormente deberá presentar su Declaración Jurada impresa en el CENS 462 (calle 71 e/ 115 y 116 Nº 232) el día Miércoles 28 de Abril en el horario de 12 a 14, o Viernes 30 de abril de 18 a 19:30 donde se controlará la declaración y se le pedirá que firme la toma de posesión General.</p>
<p>Dejamos a su disposición el número del director Luis García para cualquier consulta 2215407540</p> 
<br>
<p>Para la declaración Jurada puede utilizar el siguiente formato: <a href="https://planfines2.com.ar/wp/wp-content/uploads/2021/04/Declaracion-Jurada-de-Cargos.xls">Descargar</a></p>
<br>
-- 
<br>
Saluda a Usted muy atentamente:
<br>
Equipo de Coordinadores del Plan Fines 2 CENS 462
<br><a href="https://planfines2.com.ar">https://planfines2.com.ar</a>
';



    $email =  (!Validation::is_empty($t["docente"]->_get("email_abc"))) ? $t["docente"]->_get("email_abc") : $t["docente"]->_get("email");

    $addresses = [
      $email => $t["docente"]->_get("nombres") . " " . $t["docente"]->_get("apellidos"),
    ];

    email($addresses, $subject, $body);

    return true;

  }

}
