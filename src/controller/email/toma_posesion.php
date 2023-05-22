<?php

require_once("../config/config.php");
require_once("Container.php");
require_once("function/email.php");

class EmailTomaPosesion {

    public $entity_name;
    public $container;

    public function main($id_toma){
        $toma = $this->container->query("toma")
          ->param("id",$id_toma)->fields()->one();

        
    $t = $this->container->tools("toma")->value($toma);

    $curso = $toma["sede-numero"].$toma["comision-division"]."/".$toma["planificacion-anio"].$toma["planificacion-semestre"]." ".$toma["asignatura-nombre"];
    $subject = "Toma de posesión: " . $curso;

    $body = '
<p>Hola ' . $t["docente"]->_get("nombres", "Xx Yy") . ' ' . $t["docente"]->_get("apellidos", "Xx Yy") . ', usted ha recibido este email porque fue designado/a en la asignatura <strong>' . $curso . '</strong> de sede ' . $toma["sede-nombre"] . '</p>
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
<p>Posteriormente deberá presentarse a una entrevista con el director en el CENS 462 (calle 71 e/ 115 y 116 Nº 232) de Lunes a Viernes en el horario de 12 a 15, o los días Martes, Miércoles y Viernes de 18 a 21 o Viernes de 18 a 21 para firmar la toma de posesión.</p>
<p>Dejamos a su disposición el número del CENS 462 para cualquier consulta 2216713326 (solo mensajes y audios de Whatsapp)</p> 
<br>
<p>Para la declaración Jurada puede utilizar el siguiente formato: <a href="https://planfines2.com.ar/wp/wp-content/uploads/2021/04/Declaracion-Jurada-de-Cargos.xls">Descargar</a></p>
<br>
<p><strong>Importante</strong></p>
<p>Si toma posesión en más de una asignatura, envié la misma información en cada email de forma separada</p>
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
