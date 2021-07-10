<?php

require_once("class/controller/ModelTools.php");

require_once("function/array_combine_keys.php");
require_once("function/array_combine_key.php");


class HorariosComisionPersist  {
  /**
   * Definir horarios de todos los cursos de una comision
   * Los días y horarios se acomodan aleatoriamente
   */

  protected $cursos = [];
  protected $distribucionesHorarias = [];

  public function main($data) {
    /**
     * @param $data["id"] Id de la comision a la cual se definiran los horarios
     * @param $data["dias"] Dias de la comision a la cual se definiran los horarios
     * @param $data["hora_inicio"] Hora de inicio
     */
    if(empty($data["id"])) throw new Exception("Dato no definido: id comision");
    if(empty($data["dias"])) throw new Exception("Dato no definido: dias");
    if(empty($data["hora_inicio"])) throw new Exception("Dato no definido: hora inicio");

    $this->id = $data["id"];
    
    $this->checkHorarios();
    /**
     * si la comision tiene horarios, no seran definidos
     */

    $this->getCursos();
  
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

    $this->dias = $data["dias"];
    if(!shuffle($this->dias)) throw new Exception("No se pudo asignar un orden aleatorio a los días");
    /**
     * asignar un orden aleatorio a los dias
     */
    
    $this->getDistribucionesHorarias();
    /**
     * Obtener las distribuciones horarias utilizando el plan, año y semestre de la comision
     */


    $this->cargasHorariasXAsignatura = ModelTools::cargasHorariasXAsignaturaDeDistribucionesHorarias($this->distribucionesHorarias);
    /**
     * Definir las cargas horarias de las asignaturas
     */

     

    $this->controlarCargasHorariasDeCursos();

   
    /**
     * Las horas catedra definidas en los cursos deben coincidir con la carga horaria de las asignaturas de las distribuciones horarias.
     */

    return $this->definirHorarios($data["hora_inicio"]);
  }

  public function checkHorarios(){
    $render = new Render("horario");
    $render->setCondition(["cur-comision","=", $this->id]);
    if($this->container->getDb()->count("horario", $render)) throw new Exception("Ya existen horarios para la comision " . $this->id);
  }

  public function getCursos(){
    $render = new Render("curso");
    $render->setCondition(["comision","=", $this->id]);
    $this->cursos = $this->container->getDb()->all("curso", $render);  
    if(empty($this->cursos)) throw new Exception("No existen cursos para la comision " . $this->id);
  }


  public function getDistribucionesHorarias() {
    $render = $this->container->getRender("distribucion_horaria");
    $render->addCondition(["dis-planificacion","=",$this->cursos[0]["com_planificacion"]]);
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

    $detail = [];
    $sql = "";
    foreach($this->distribucionesHorarias as $dh){
      $horario = $this->container->getValue("horario"); 
      
      $hora = DateTime::createFromFormat("H:i:s", $horaInicio);  
      
      if(!key_exists($dh["dia"], $horasCatedrasDia)) $horasCatedrasDia[$dh["dia"]] = 0;
      $minutos = $horasCatedrasDia[$dh["dia"]];

      $hora->modify("+{$minutos} minute");
      $horario->_fastSet("hora_inicio", clone $hora);

      $minutos = intval($dh["horas_catedra"]) * 40;
      $hora->modify("+{$minutos} minute");
      $horario->_fastSet("hora_fin", clone $hora);

      $horasCatedrasDia[$dh["dia"]] += $minutos;
      
      $horario->_fastSet("dia", $this->dias[intval($dh["dia"])-1]);
      $horario->_fastSet("curso", $this->cursosXAsignaturas[$dh["dis_asignatura"]]["id"]);

      $persist = $this->container->getControllerEntity("persist_sql_value","horario")->id($horario);
      array_push($detail,"horario".$persist["id"]);
      $sql .= $persist["sql"];
    }

    $this->container->getDb()->multi_query_transaction($sql);

    return ["id" => $this->id, "detail" => $detail];
  }

  


  
    


}




