<?php

set_time_limit(0);  
require_once("class/controller/Base.php");
require_once("function/array_group_value.php");
require_once("function/array_combine_key.php");


class PreigesScript extends BaseController{
 /**
   * Formulario para cargar calificaciones
   * ./script/calificacion_form
   */

  public function main(){
    $render = $this->container->getRender("horario");
    $render->setCondition([
      ["calendario-anio","=","2022"],
      ["calendario-semestre","=","2"],
      //["cur_com_sed-centro_educativo","=","1"],
    ]);
    $render->setSize(false);
    $render->setOrder(["cur_com_sed-numero"=>"ASC","cur_com-division"=>"ASC"]);
    $horarios = $this->container->getDb()->all("horario",$render);
    
    $render = $this->container->getRender("toma");
    $render->setCondition([
      ["calendario-anio","=","2022"],
      ["calendario-semestre","=","2"],
      ["centro_educativo-id","=","1"],
      ["estado","=","Aprobada"],
      ["estado_contralor","=","Pasar"]
    ]);
    $render->setSize(false);
    $render->setOrder(["doc-nombres"=>"ASC","doc-apellidos"=>"ASC"]);
    $docentes = $this->container->getDb()->all("toma",$render);
    $curso_docentes = array_combine_key($docentes, "curso");
    
    $comision_horarios = array_group_value($horarios, "cur_comision");
    
    $comision_cursos_horarios = [];
    $cursos_horarios = [];
    foreach($comision_horarios as $key => $horarios_comision){
      $comision_cursos_horarios[$key] = array_group_value($horarios_comision, "curso");
    }
    
    foreach($comision_cursos_horarios as $comision => $cursos){
      foreach($cursos as $curso => $horarios){
        $cursos_horarios[$curso] = ["","","","",""];
        foreach($horarios as $horario){
          $h = $this->container->getRel("horario")->value($horario);
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
    require_once("class/script/Preiges.html");
  }
}