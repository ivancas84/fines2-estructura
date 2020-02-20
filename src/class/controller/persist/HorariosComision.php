<?php


require_once("class/controller/Persist.php");
require_once("class/model/Ma.php");
require_once("class/model/Values.php");
require_once("class/controller/persist/ComisionCursos.php");
require_once("function/array_combine_keys.php");



class HorariosComisionPersist extends Persist {

  protected $curso_ = [];
  protected $distribucion_horaria_ = [];

  public function main($data) {
    /**
     * @param $data["id"] Id de la comision a la cual se definiran los horarios
     * @param $data["dias"] Dias de la comision a la cual se definiran los horarios
     * @param $data["hora_inicio"] Hora de inicio
     */
    if(empty($data["id"])) throw new Exception("Dato no definido: id comision");
    if(empty($data["dia_"])) throw new Exception("Dato no definido: dia_");
    if(empty($data["hora_inicio"])) throw new Exception("Dato no definido: hora inicio");
    
    $this->checkHorario_($data["id"]);
    $this->getCurso_($data["id"]);
    $this->getDia_($data["dia_"]);
    $this->getDistribucionHoraria_();
    $this->definirHorario_($data["hora_inicio"]);
  }

  public function checkHorario_($comision){
    if(Ma::count("horario", ["cur_comision","=", $comision])) throw new Exception("Ya existen horarios para la comision indicada");
  }

  public function getCurso_($comision){
    $this->curso_ = Ma::all("curso", ["comision","=", $comision]);  
    if(empty($this->curso_)) throw new Exception("No existen cursos para la comision indicada");
  }

  public function getDia_($dia_){
    if(!shuffle($dia_)) throw new Exception("No se pudo asignar un orden aleatorio a los días");
    $this->dia_ = $dia_;
  }

  public function getDistribucionHoraria_() {
    $params = [
      "ch_plan" => $this->curso_[0]["com_plan"],
      "ch_anio" => $this->curso_[0]["com_anio"],
      "ch_semestre" => $this->curso_[0]["com_semestre"],
    ];

    $render = Render::getInstanceParams($params);

    $this->distribucionHoraria_ = Ma::all("distribucion_horaria", $render);
    if(empty($this->distribucionHoraria_)) throw new Exception("No existen distribuciones horarias para la comision indicada");
    if(!shuffle($this->distribucionHoraria_)) throw new Exception("No se pudo asignar orden aleatorio a la distribucion horaria");
    if(
      count(array_unique(array_column($this->distribucionHoraria_, "dia"))) 
      != count($this->dia_)
    ) throw new Exception("La cantidad de dias de la distribucion horaria no coincide con la cantidad de dias definidos");
  }

  public function definirHorario_($horaInicio){
    $carga_horaria_x_curso = array_combine_keys($this->curso_,"carga_horaria","id");
 
    $horasCatedrasAsignadasPorDia = [];
    
    foreach($this->distribucionHoraria_ as $dh){
      $horario = EntityValues::getInstanceRequire("horario");
      
      $hora = DateTime::createFromFormat("H:i", $horaInicio);  
      
      if(!key_exists($dh["dia"], $horasCatedrasAsignadasPorDia)) $horasCatedrasAsignadasPorDia[$dh["dia"]] = 0;
      $minutos = $horasCatedrasAsignadasPorDia[$dh["dia"]];

      $hora->modify("+{$minutos} minute");
      $horario->_setHoraInicio(clone $hora);

      //$horario["hora_inicio"] = $hora->format("H:i") . ":00";

      $minutos = intval($dh["horas_catedra"]) * 40;
      $hora->modify("+{$minutos} minute");
      $horario->_setHoraFin(clone $hora);
      //$horario["hora_fin"] = $hora->format("H:i") . ":00";

      $horasCatedrasAsignadasPorDia[$dh["dia"]] += $minutos;
      
      $horario->setDia($this->dia_[intval($dh["dia"])-1]);
      $horario->setCurso($carga_horaria_x_curso[$dh["carga_horaria"]]);

      $this->insert("horario", $horario->_toArray());
    }

  }

  


  
    


}




