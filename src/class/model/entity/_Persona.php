<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _PersonaEntity extends Entity {
  public $name = "persona";
  public $alias = "pers";
  public $main = ['id'];
  public $pk = ['id'];
  public $nf = ['nombres', 'apellidos', 'fecha_nacimiento', 'numero_documento', 'cuil', 'genero', 'apodo', 'telefono', 'email', 'email_abc', 'alta'];
  public $mu = ['domicilio'];
  public $_u = [];
  public $notNull = ['id', 'nombres', 'numero_documento', 'alta'];
  public $unique = ['id', 'numero_documento', 'cuil', 'email_abc'];
  public $admin = ['id', 'nombres', 'apellidos', 'fecha_nacimiento', 'numero_documento', 'cuil', 'genero', 'apodo', 'telefono', 'email', 'email_abc', 'alta', 'domicilio'];



}
