<?php

set_time_limit(0);  
require_once("controller/base.php");
require_once("function/array_group_value.php");
require_once("function/array_combine_key.php");


class PreigesScript extends BaseController{
 /**
   * Formulario para cargar calificaciones
   * ./script/calificacion_form
   */

  public function main(){
    $anio_calendario = $_GET["anio_calendario"];
    $semestre_calendario = $_GET["semestre_calendario"];

    $calendario_comisiones = $this->container->controller("comisiones","calendario");

    $horarios = $calendario_comisiones->horarios_comisiones_autorizadas($anio_calendario, $semestre_calendario);
    $comision_horarios = array_group_value($horarios, "comision-id");

    $docentes = $calendario_comisiones->tomas_aprobadas_comisiones_autorizadas($anio_calendario, $semestre_calendario);
    $curso_docentes = array_combine_key($docentes, "curso-id");
    
    $comision_cursos_horarios = [];
    foreach($comision_horarios as $key => $horarios_comision){
      $comision_cursos_horarios[$key] = array_group_value($horarios_comision, "curso");
    }

    $cursos_horarios = [];
    foreach($comision_cursos_horarios as $comision => $cursos){
      foreach($cursos as $curso => $horarios){
        $cursos_horarios[$curso] = ["","","","",""];
        foreach($horarios as $horario){
          $h = $this->container->tools("horario")->value($horario);
          switch($h["dia"]->_get("numero")){
            case "0":
              $cursos_horarios[$curso][0] = $h["horario"]->_get("hora_inicio", "H:i") . " a " . $h["horario"]->_get("hora_fin","H:i");
            break;
            case "1":
              $cursos_horarios[$curso][1] = $h["horario"]->_get("hora_inicio", "H:i"). " a " . $h["horario"]->_get("hora_fin","H:i");
            break;
            case "2":
              $cursos_horarios[$curso][2] = $h["horario"]->_get("hora_inicio", "H:i"). " a " . $h["horario"]->_get("hora_fin","H:i");
            break;
            case "3":
              $cursos_horarios[$curso][3] = $h["horario"]->_get("hora_inicio", "H:i"). " a " . $h["horario"]->_get("hora_fin","H:i");
            break;
            case "4":
              $cursos_horarios[$curso][4] = $h["horario"]->_get("hora_inicio", "H:i"). " a " . $h["horario"]->_get("hora_fin","H:i");
            break;
          }  
        }
      }
    }
    require_once("script/preiges.html");
  }

  
}