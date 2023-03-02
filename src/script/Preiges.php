<?php

set_time_limit(0);  
require_once("controller/base.php");
require_once("function/array_group_value.php");
require_once("function/array_combine_key.php");
require_once("function/array_combine_keys.php");


class PreigesScript extends BaseController{
 /**
   * Formulario para cargar calificaciones
   * ./script/calificacion_form
   */

  public function main(){
    $anio_calendario = $_GET["anio_calendario"];
    $semestre_calendario = $_GET["semestre_calendario"];

    $comisiones_autorizadas = $this->container->query("comision")
      ->param("calendario-anio",$anio_calendario)
      ->param("calendario-semestre",$semestre_calendario)
      ->param("autorizada",true)
      ->order(["sede-numero"=>"ASC","division"=>"ASC"])
      ->size(0)->fields()->all();
    $ids_comisiones_autorizadas = array_column($comisiones_autorizadas, "id");

    $curso_tomas_aprobadas = $this->container->query("toma")
      ->cond([
          ["comision-id","=",$ids_comisiones_autorizadas],
          // ["estado","=","Aprobada"],
          ["estado_contralor","=","Pasar"]
        ])
      ->order(["docente-nombres"=>"ASC","docente-apellidos"=>"ASC"])
      ->size(0)->fields()->all();
    $curso_tomas_aprobadas = array_combine_key($curso_tomas_aprobadas, "curso");

    $referentes_mas_actual = $this->container->controller("referentes","comision")->referente_mas_actual($ids_comisiones_autorizadas);
    $ids_persona = array_column($referentes_mas_actual, "persona");
    $referentes_mas_actual = array_combine_keys($referentes_mas_actual, "comision","persona"); //agrupar por comision
    $personas = $this->container->query("persona")    
      ->param("id", $ids_persona)
      ->fields()->size(0)->all();
      
    $personas = array_combine_key($personas, "id");
    
    $cantidad_alumnos_activos = $this->container->controller("alumnos","comision")->cantidad_alumnos_activos($ids_comisiones_autorizadas);
    $cantidad_alumnos_activos = array_combine_keys($cantidad_alumnos_activos, "comision", "cantidad");


    $comision_horarios = $this->container->query("horario")
            ->param("comision-id",$ids_comisiones_autorizadas)
            ->order(["sede-numero"=>"ASC","comision-division"=>"ASC", "asignatura-nombre"=>"ASC"])
            ->size(0)
            ->fields()
            ->all();

        $comision_horarios = array_group_value($comision_horarios, "comision-id");
        $comision_cursos_horarios = [];
        foreach($comision_horarios as $id_comision => $horarios_comision){
          $comision_cursos_horarios[$id_comision] = array_group_value($horarios_comision, "curso");
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