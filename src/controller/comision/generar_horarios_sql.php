<?php

require_once("function/array_combine_keys.php");
require_once("function/array_combine_key.php");


class ComisionGenerarHorariosSql  {
    /**
     * Definir horarios de todos los cursos de una comision
     * Los días y horarios se acomodan aleatoriamente
     */

    protected $cursos = [];
    protected $distribucionesHorarias = [];
    protected $dia_ = [];


    public function main(string $id_comision, string $hora_inicio, array $dias) {
        /**
         * las asignaturas de los cursos deben coincidir con los de las distribuciones horarias
         * sin embargo la comision puede tener cursos adicionales los cuales no seran considerados
         * la comision no puede tener dos cursos referidos a la misma asignatura, se efectuara un error al combinar
         */

        //verificar si la comision tiene horarios
        $h = $this->container->query("horario")->cond(["comision-id","=", $id_comision])
        ->size(0)->page(1)->fields(["count"])->columnOne();
        if(intval($h)) throw new Exception("Ya existen horarios para la comision " . $id_comision);
      
        //consultar cursos y agruparlos por asignatura
        $cursos = $this->container->query("curso")->cond(["comision","=", $id_comision])->fields()->all();  
        if(empty($cursos)) throw new Exception("No existen cursos para la comision " . $id_comision);
        $cursos = array_combine_key($cursos,"asignatura");

        //asignar un orden aleatorio a los dias
        if(!shuffle($dias)) throw new Exception("No se pudo asignar un orden aleatorio a los días");

        //consultar distribuciones horarias
        $render = $this->container->getEntityRender("distribucion_horaria");
        $render->addCondition(["dis-planificacion","=",$this->cursos[0]["com_planificacion"]]);
        $this->distribucionesHorarias = $this->container->db()->all("distribucion_horaria", $render);


        $this->cargasHorariasXAsignatura = $this->container->getMt()->cargasHorariasXAsignaturaDeDistribucionesHorarias($this->distribucionesHorarias);
        /**
         * Definir las cargas horarias de las asignaturas
         */

        

        $this->controlarCargasHorariasDeCursos();

      
        /**
         * Las horas catedra definidas en los cursos deben coincidir con la carga horaria de las asignaturas de las distribuciones horarias.
         */

        return $this->definirHorarios($data["hora_inicio"]);
    }


    public function getDistribucionesHorarias() {
      $render = $this->container->getEntityRender("distribucion_horaria");
      $render->addCondition(["dis-planificacion","=",$this->cursos[0]["com_planificacion"]]);
      $this->distribucionesHorarias = $this->container->db()->all("distribucion_horaria", $render);
      
      if(empty($this->distribucionesHorarias)) throw new Exception("No existen distribuciones horarias para la comision indicada: " . $this->id);
      if(!shuffle($this->distribucionesHorarias)) throw new Exception("No se pudo asignar orden aleatorio a la distribucion horaria");
      if(
        count(array_unique(array_column($this->distribucionesHorarias, "dia"))) 
        != count($this->dia_)
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
        $horario = $this->container->value("horario"); 
        
        $hora = DateTime::createFromFormat("H:i", $horaInicio); 
        if(!$hora) $hora = DateTime::createFromFormat("H:i:s", $horaInicio); 
        
        if(!key_exists($dh["dia"], $horasCatedrasDia)) $horasCatedrasDia[$dh["dia"]] = 0;
        $minutos = $horasCatedrasDia[$dh["dia"]];

        $hora->modify("+{$minutos} minute");
        $horario->_fastSet("hora_inicio", clone $hora);

        $minutos = intval($dh["horas_catedra"]) * 40;
        $hora->modify("+{$minutos} minute");
        $horario->_fastSet("hora_fin", clone $hora);

        $horasCatedrasDia[$dh["dia"]] += $minutos;
        
        $horario->_fastSet("dia", $this->dia_[intval($dh["dia"])-1]);
        $horario->_fastSet("curso", $this->cursosXAsignaturas[$dh["dis_asignatura"]]["id"]);

        $persist = $this->container->controller("persist_sql_value","horario")->id($horario);
        array_push($detail,"horario".$persist["id"]);
        $sql .= $persist["sql"];
      }

      //$this->container->db()->multi_query_transaction($sql);

      return ["id" => $this->id, "detail" => $detail, "sql"=>$sql];
    }

    


    
    


}




