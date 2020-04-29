<?php

require_once("class/controller/Persist.php");
require_once("class/model/Ma.php");
require_once("class/model/Values.php");
require_once("class/controller/persist/ComisionCursos.php");
require_once("class/controller/ModelTools.php");

require_once("function/array_combine_keys.php");
require_once("function/array_combine_key.php");


class HorariosComisionPersist extends Persist {
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

    $this->definirHorarios($data["hora_inicio"]);
  }

  public function checkHorarios(){
    if(Ma::count("horario", ["cur_comision","=", $this->id])) throw new Exception("Ya existen horarios para la comision " . $this->id);
  }

  public function getCursos(){
    $this->cursos = Ma::all("curso", ["comision","=", $this->id]);  
    if(empty($this->cursos)) throw new Exception("No existen cursos para la comision " . $this->id);
  }


  public function getDistribucionesHorarias() {
    $params = [
      "plan" => $this->cursos[0]["com_plan"],
      "anio" => $this->cursos[0]["com_anio"],
      "semestre" => $this->cursos[0]["com_semestre"],
    ];

    $render = Render::getInstanceParams($params);

    $this->distribucionesHorarias = Ma::all("distribucion_horaria", $render);
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
      $horario = EntityValues::getInstanceRequire("horario");
      
      $hora = DateTime::createFromFormat("H:i:s", $horaInicio);  
      
      if(!key_exists($dh["dia"], $horasCatedrasDia)) $horasCatedrasDia[$dh["dia"]] = 0;
      $minutos = $horasCatedrasDia[$dh["dia"]];

      $hora->modify("+{$minutos} minute");
      $horario->_setHoraInicio(clone $hora);

      $minutos = intval($dh["horas_catedra"]) * 40;
      $hora->modify("+{$minutos} minute");
      $horario->_setHoraFin(clone $hora);

      $horasCatedrasDia[$dh["dia"]] += $minutos;
      
      $horario->setDia($this->dias[intval($dh["dia"])-1]);
      $horario->setCurso($this->cursosXAsignaturas[$dh["asignatura"]]["id"]);

      if($horario->_logs()->isError()) throw new Exception("El horario posee errores en la asignacion de valores");

      $this->insert("horario", $horario->_toArray());
    }

  }

  


  
    


}




