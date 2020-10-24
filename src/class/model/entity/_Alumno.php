<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AlumnoEntity extends Entity {
  public $name = "alumno";
  public $alias = "alum";
  public $nf = ['fotocopia_documento', 'partida_nacimiento', 'creado', 'constancia_cuil', 'certificado_estudios', 'anio_ingreso', 'activo', 'programa', 'observaciones', 'comision_aux', 'region', 'distrito', 'localidad', 'programa_aux', 'inscripcion_men', 'cens', 'sede', 'tramo', 'identificador', 'numero_inscripcion', 'trayectoria_educativa', 'turno', 'pc_escritorio', 'net_notebook', 'tablet', 'pc_tablet', 'impresora', 'conexion_internet_paga', 'telefono_celular', 'comision_2020', 'archivo_2019', 'archivo_2020', 'drive', 'cuil'];
  public $mu = ['persona', 'comision'];
  public $_u = [];
  public $notNull = ['id', 'fotocopia_documento', 'partida_nacimiento', 'creado', 'constancia_cuil', 'certificado_estudios', 'persona'];
  public $unique = ['id'];


}
