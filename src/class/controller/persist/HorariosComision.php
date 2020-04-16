<?php

require_once("class/controller/Persist.php");
require_once("class/model/Ma.php");
require_once("class/model/Values.php");
require_once("class/controller/persist/ComisionCursos.php");
require_once("function/array_combine_keys.php");

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
    
    $this->checkHorarios($data["id"]);
    $this->getCursos($data["id"]);
    $this->getDias($data["dias"]);
    $this->getDistribucionesHorarias();
    $this->definirHorarios($data["hora_inicio"]);
  }

  public function checkHorarios($comision){
    if(Ma::count("horario", ["cur_comision","=", $comision])) throw new Exception("Ya existen horarios para la comision indicada");
  }

  public function getCursos($comision){
    $this->cursos = Ma::all("curso", ["comision","=", $comision]);  
    if(empty($this->cursos)) throw new Exception("No existen cursos para la comision indicada");
  }

  public function getDias($dias){
    if(!shuffle($dias)) throw new Exception("No se pudo asignar un orden aleatorio a los días");
    $this->dias = $dias;
  }

  public function getDistribucionesHorarias() {
    $params = [
      "ch_plan" => $this->cursos[0]["com_plan"],
      "ch_anio" => $this->cursos[0]["com_anio"],
      "ch_semestre" => $this->cursos[0]["com_semestre"],
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

  public function definirHorarios($horaInicio){
    $carga_horaria_x_curso = array_combine_keys($this->cursos,"carga_horaria","id");
 
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
      $horario->setCurso($carga_horaria_x_curso[$dh["carga_horaria"]]);

      if($horario->_logs()->isError()){
        throw new Exception("El horario posee errores en la asignacion de valores");
      }

      $this->insert("horario", $horario->_toArray());
    }

  }

  


  
    


}




