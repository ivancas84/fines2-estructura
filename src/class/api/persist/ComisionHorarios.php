<?php

require_once("class/api/Persist.php");
require_once("class/controller/ModelTools.php");

require_once("function/array_combine_keys.php");
require_once("function/array_combine_key.php");


class ComisionHorariosPersistApi extends PersistApi {
  /**
   * Registro de cursos de una comision
   */

  public $sql = ""; //sql de horarios insertados
  public $ids = []; //ids de horarios insertados
  public $id; //id comision

  public function main(){
    $data = Filter::jsonPostRequired();

    if(empty($data["id"])) throw new Exception("Dato no definido: id comision");
    if(empty($data["dias"])) throw new Exception("Dato no definido: dias");
    if(empty($data["hora_inicio"])) throw new Exception("Dato no definido: hora inicio");

    $this->id = $data["id"];

    $this->verificarHorarios();
    /**
     * si la comision tiene horarios, no seran definidos
     */

    $this->cursos(); //$this->cursos
    /**
     * obtener los cursos de la comision para poder asignar los horarios
     * las asignaturas de los cursos deben coincidir con los de las distribuciones horarias
     * sin embargo la comision puede tener cursos adicionales los cuales no seran considerados
     * la comision no puede tener dos cursos referidos a la misma asignatura, se efectuara un error al combinar
     */

    $this->cursosXAsignaturas = array_combine_key($this->cursos,"asignatura");
    /**
     * Agrupar los cursos por asignatura
     */

    $this->dias($data["dias"]); //$this->dias
    /**
     * Definir un dias con un orden aleatorio
     */

    $this->distribucionesHorarias(); //$this->distribucionesHorarias
    /**
     * Obtener las distribuciones horarias utilizando la planificacion
     */

    $this->cargasHorariasXAsignatura = $this->container->getMt()->cargasHorariasXAsignaturaDeDistribucionesHorarias($this->distribucionesHorarias);
    /**
     * Definir las cargas horarias de las asignaturas
     */

    $this->controlarCargasHorariasDeCursos();
    /**
     * Las horas catedra definidas en los cursos deben coincidir con la carga horaria de las asignaturas de las distribuciones horarias.
     */

    $this->definirHorarios($data["hora_inicio"]);

    $this->container->getDb()->multi_query_transaction_log($this->sql);
    

    return ["id" => $this->id, "detail" => array_map(function($id) { return "horario".$id; } , $this->ids)];
  }

  public function verificarHorarios(){
    if($this->container->getDb()->count("horario", ["cur_comision","=", $this->id])) throw new Exception("Ya existen horarios para la comision");
  }

  public function cursos(){
    $this->cursos = $this->container->getDb()->all("curso", ["comision","=", $this->id]);  
    if(empty($this->cursos)) throw new Exception("No existen cursos para la comision " . $this->id);
  }

  public function dias($dias){
    $this->dias = $dias;
    if(!shuffle($this->dias)) throw new Exception("No se pudo asignar un orden aleatorio a los días");
  }

  public function distribucionesHorarias() {
    $params = [
      "planificacion" => $this->cursos[0]["com_planificacion"],
    ];

    $render = Render::getInstanceParams($params);

    $this->distribucionesHorarias = $this->container->getDb()->all("distribucion_horaria", $render);
    if(empty($this->distribucionesHorarias)) throw new Exception("No existen distribuciones horarias para la comision indicada: " . $this->id);
    if(!shuffle($this->distribucionesHorarias)) throw new Exception("No se pudo asignar orden aleatorio a la distribucion horaria");
    if(
      count(array_unique(array_column($this->distribucionesHorarias, "dia"))) 
      != count($this->dias)
    ) throw new Exception("La cantidad de dias de la distribucion horaria no coincide con la cantidad de dias definidos en comision: " . $this->id);  
  }

  public function controlarCargasHorariasDeCursos(){
    foreach($this->cargasHorariasXAsignatura as $asignatura => $horasCatedras){
      $curso = $this->cursosXAsignaturas[$asignatura];
      if(intval($horasCatedras) != intval($curso["horas_catedra"])) throw new Exception("No coincide la carga horaria obtenida de la distribucion horaria con las horas catedra del curso en comision " . $this->id . " para el curso " . $curso["id"]);
    }
  }

  public function definirHorarios($horaInicio){
    $horasCatedrasDia = [];
    
    foreach($this->distribucionesHorarias as $dh){
      $horario = $this->container->getValue("horario");

      $hora = new DateTime($horaInicio);
      if($hora instanceof DateTime) $hora->setTimeZone(new DateTimeZone(date_default_timezone_get()));
      
      if(!key_exists($dh["dia"], $horasCatedrasDia)) $horasCatedrasDia[$dh["dia"]] = 0;
      $minutos = $horasCatedrasDia[$dh["dia"]];

      $hora->modify("+{$minutos} minute");
      $horario->_setHoraInicio(clone $hora);

      $minutos = intval($dh["horas_catedra"]) * 40;
      $hora->modify("+{$minutos} minute");
      $horario->_setHoraFin(clone $hora);

      $horasCatedrasDia[$dh["dia"]] += $minutos;
      
      $horario->setDefaultId();
      $horario->setDia($this->dias[intval($dh["dia"])-1]);
      $horario->setCurso($this->cursosXAsignaturas[$dh["asignatura"]]["id"]);

      if($horario->_getLogs()->isError()) throw new Exception("El horario posee errores en la asignacion de valores");

      $horario->_call("setDefault");
      $horario->setId(uniqid());
      $this->sql = $this->container->getSqlo("horario")->insert($horario->_toArray("sql"));
      array_push($this->ids, $horario->id());
    }
  }
}