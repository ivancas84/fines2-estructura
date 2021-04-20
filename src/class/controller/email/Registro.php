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
<p>Para completar su toma de posesión, necesitamos que a la brevedad se comunique con el director del CENS 462 Luis García al número 221 5407540</p>
<p>Y posteriormente necesitamos que responda este email y nos envíe por este medio una foto de su DNI y Declaración Jurada de Cargos.</p>
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
