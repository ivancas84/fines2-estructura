<?php

require_once("class/model/entity/_Persona.php");

class PersonaEntity extends _PersonaEntity  {
 
  public $main = ["nombres","apellidos","numero_documento"];
  public $nf = ['nombres', 'apellidos', 'fecha_nacimiento', 'numero_documento', 'cuil', 'genero', 'apodo', 'telefono', 'email', 'email_abc', 'alta',
    'primer_nombre_apellido', 'primer_apellido_nombre'];
  public $noAdmin = ['primer_nombre_apellido', 'primer_apellido_nombre'];

}
