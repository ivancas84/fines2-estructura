<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _PersonaEntity extends Entity {
  public $name = "persona";
  public $alias = "pers";
  public $nf = ['nombres', 'apellidos', 'fecha_nacimiento', 'numero_documento', 'cuil', 'genero', 'apodo', 'telefono', 'email', 'email_abc', 'alta', 'lugar_nacimiento', 'telefono_verificado', 'email_verificado'];
  public $mu = ['domicilio'];
  public $_u = [];
  public $notNull = ['id', 'nombres', 'numero_documento', 'alta', 'telefono_verificado', 'email_verificado'];
  public $unique = ['id', 'numero_documento', 'cuil', 'email_abc'];


}
