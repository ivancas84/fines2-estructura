<?php

require_once("../config/config.php");
require_once("class/Container.php");
require_once("function/email.php");

class EmailRegistro {

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
    <li>Declaración Jurada</li>
    <li>Proyecto pedagógico</li>
    <li>Copia de email con aviso de designación (para docentes designados en SAD)</li>
  </ul>
</p>
<p>Posteriormente deberá presentarse a una entrevista con el director en el CENS 462 (calle 71 e/ 115 y 116 Nº 232) de Lunes a Jueves en el horario de 12 a 15, o los días Lunes de 18 a 21 o Viernes de 18 a 21 para firmar la toma de posesión.</p>
<p>Dejamos a su disposición el número del CENS 462 para cualquier consulta 2216713326 (solo mensajes y audios de Whatsapp)</p> 
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



    $email =  (!Validation::is_empty($t["docente"]->_get("email"))) ? $t["docente"]->_get("email") : $t["docente"]->_get("email");

    $addresses = [
      $email => $t["docente"]->_get("nombres") . " " . $t["docente"]->_get("apellidos"),
    ];

    email($addresses, $subject, $body);

    return true;

  }

}
