<?php

require_once("class/model/Render.php");
require_once("class/model/Ma.php");

class ModelTools {
  /**
   * Clase especial para colocar codigo de uso comun
   * 
   * La idea de ModelTools es ejecutar consultas a la base de datos de uso
   * general. ModelTools no almacena ninguna información, puede ser utilizada
   * como singleton.
   */
  public $container;

  public function labelCurso($data, $prefix){
    /**
     * Definir la etiqueta de curso a partir de $data
     * $data es el resultado de una consulta a la base de datos sin aplicar ningun filtro por ejemplo
     * ["id" => "v", "field" => "v", "fk_id" => "v", "fk_field" => "v", "fk2_fk_id" => "v" , "fk2_fk_field" => "v", ...]
     */
    $label = $data[$prefix."com_sed_numero"] . $data[$prefix."com_division"] . "/";

    if($data[$prefix."com_pla_id"]) 
      $label .= $data[$prefix."com_pla_anio"].$data[$prefix."com_pla_semestre"];

    $label .= " " . $data[$prefix."asi_nombre"];

    return $label;
  }


  public function distribucionesHorarias($planificacion){
    if(empty($planificacion)) throw new Exception("Planificacion vacia");
    return $this->getDb()->all("distribucion_horaria", ["planificacion"=>$planificacion]);
  }

  public function cantidadAlumnosAprobadosComision($idsComisiones){
    $render = $this->container->getRender("calificacion");
    $render->setCondition([
      ["cur-comision","=",$idsComisiones],
      [
        ["nota_final",">","7"],
        ["crec",">","4"]
      ]
    ]);
    $render->setFields(["aprobados"=>"persona.count"]);
    $render->setGroup(["comision"=>"cur-comision"]);
    
    return $this->container->getDb()->select("calificacion",$render);
  }

  public function sumaHorasCatedraAsignaturasGrupo($fechaAnio, $fechaSemestre, $modalidad, $centroEducativo){
    /**
     * @param fechaAnio
     * @param fechaSemestre
     * @param modalidad
     * @param centroEducativo
     */
    $params = [
      "com_fecha_anio" => $fechaAnio,
      "com_fecha_semestre" => $fechaSemestre,
      "com_modalidad" =>  $modalidad,
      "com_sed_centro_educativo" => $centroEducativo
    ];

    $render = Render::getInstanceParams($params);
    $render->setAggregate(["ch_sum_horas_catedra"]);
    $render->setGroup(["ch_asignatura"]);
    $render->setOrder(["ch_sum_horas_catedra" =>"desc"]);

    return $this->container->getDb()->advanced("curso",$render);
  }

  public function cargasHorariasDePlanificacion($planificacion){
    if(empty($planificacion)) throw new Exception("Planificacion no definida");
    $render = $this->container->getRender("distribucion_horaria");
    $render->setParams(["dis-planificacion" => $planificacion]);
    $render->setFields(["horas_catedra.sum"]);
    $render->setGroup(["planificacion" => "dis-planificacion", "asignatura"=>"dis-asignatura"]);
    $render->setOrder(["horas_catedra.sum" => "desc"]);
    $render->setSize(0);
    return $this->container->getDb()->select("distribucion_horaria",$render);
  }

  public function cargasHorariasXAsignaturaDeDistribucionesHorarias($distribucionesHorarias){
    /**
     * Sumar horas catedra de asignaturas para un conjunto de distribuciones horarias
     * Recorre todas las distribuciones sin verificar si corresponden al mismo plan, anio o semestre
     * Devuelve un array asociativo "asignatura" => "suma de horas catedra"
     * El concepto horasCatedraXAsignatura esta muy ligado a Carga Horaria
     * Como el metodo no hace distincion de plan, anio, semestre se renombro diferente.
     */
    $cargasHorariasXAsignatura = [];

    foreach($distribucionesHorarias as $dh){
      if(!array_key_exists($dh["dis_asignatura"], $cargasHorariasXAsignatura)) $cargasHorariasXAsignatura[$dh["dis_asignatura"]] = 0;
      $cargasHorariasXAsignatura[$dh["dis_asignatura"]] += intval($dh["horas_catedra"]);
    }

    return $cargasHorariasXAsignatura;
  }

  public function intervaloAnterior(array $grupo, $prefix = ""){
    /**
     * un intervalo es la combinación de fecha_anio, fecha_semestre
     * @param $grupo["fecha_anio"]
     * @param $grupo["fecha_semestre"]
     */
    $param = $grupo;

    $param[$prefix."anio"] = intval($grupo[$prefix."anio"]);
    $param[$prefix."semestre"] = intval($grupo[$prefix."semestre"]);

    switch($param[$prefix."semestre"]){
      case 2:  
        $param[$prefix."semestre"] = 1; 
      break;
      
      case 1: 
        $param[$prefix."anio"]--;
        $param[$prefix."semestre"] = 2; 
      break;
      
      default: 
        $param[$prefix."semestre"] = false;
        $param[$prefix."anio"]--;
    }

    return $param;
  }

  public function cursosConTomaActiva($idCursos){
    $idCursos_ = implode("','",$idCursos);
    
    $sql = "
SELECT id AS toma_activa, curso
FROM toma
WHERE (toma.estado = 'Aprobada') AND (toma.estado_contralor != 'Modificar')
AND curso IN ('{$idCursos_}')
";

    $result = $this->container->getDb()->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
    return $rows;
  }

  public function cursoHorario($idCursos){
    /**
     * @return [
     *   "curso" => "id curso",
     *   "horario" => "Lunes 16:00 a 19:00, Martes 16:00 a 19:00"
     * ]
     */
    $idCursos_ = implode("','",$idCursos);
    
    $sql = "
SELECT curso.id AS curso, GROUP_CONCAT(
  dia.dia, 
  \" \", 
  TIME_FORMAT(horario.hora_inicio, '%H:%i'), 
  \" a \", 
  TIME_FORMAT(horario.hora_fin, '%H:%i') ORDER BY dia.numero ASC SEPARATOR ', '
) AS horario
FROM curso
INNER JOIN horario ON (horario.curso = curso.id)
INNER JOIN dia ON (dia.id = horario.dia)
WHERE curso.id IN ('{$idCursos_}')
GROUP BY curso.id 
  ";

    $container = new Container();
    $result = $container->getDb()->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
    return $rows;
  }

  public function cursosConHorariosDeComision($idComision){
    
    $sql = "
  SELECT curso.id AS curso, GROUP_CONCAT(dia.dia, \" \", TIME_FORMAT(horario.hora_inicio, '%H:%i'), \" a \", TIME_FORMAT(horario.hora_fin, '%H:%i') ORDER BY dia.numero ASC SEPARATOR ', ') AS horario
  FROM curso
  INNER JOIN horario ON (horario.curso = curso.id)
  INNER JOIN dia ON (dia.id = horario.dia)
  WHERE curso.comision = '{$idComision}'
  GROUP BY curso.id
  ";

    $result = $this->container->getDb()->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
    return $rows;
  }

  
  public function diasHorariosComision(array $ids) {
    $ids_ = implode("','", $ids);

    $sql =  "

    SELECT comision.id AS comision, dias.dias_dias, dias.dias_ids, horas.hora_inicio, horas.hora_fin    
    FROM comision
    INNER JOIN (
    
    
      SELECT DISTINCT dias_.comision AS comision, GROUP_CONCAT(dias_.dia ORDER BY dias_.numero) AS dias_dias, GROUP_CONCAT(dias_.id ORDER BY dias_.numero) AS dias_ids
      FROM (
        SELECT DISTINCT comision.id AS comision, dia.dia, dia.id, dia.numero
        FROM horario
        INNER JOIN dia ON (dia.id = horario.dia)
        INNER JOIN curso ON (curso.id = horario.curso)
        INNER JOIN comision ON (comision.id = curso.comision)
        WHERE comision.id IN ('{$ids_}')
        ORDER BY dia.numero
      ) AS dias_
      GROUP BY comision
      
      
    ) AS dias ON (dias.comision = comision.id)
    INNER JOIN (


      SELECT DISTINCT comision.id AS comision, MIN(horario.hora_inicio) AS hora_inicio, MAX(horario.hora_fin) AS hora_fin
      FROM horario
      INNER JOIN curso ON (curso.id = horario.curso)
      INNER JOIN comision ON (comision.id = curso.comision)
      WHERE comision.id IN ('{$ids_}')    
      GROUP BY comision
    
    
    ) AS horas ON (horas.comision = comision.id)
    
";

    $result = $this->container->getDb()->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
    return $rows;
  }

  public function disposicionesRestantes($calificaciones, $disposiciones){
    /**
     * @derecated? 
     */
    $d = array_combine_key2(
      $disposiciones,
      ["asignatura","planificacion"]
    );
    
    $ids_c = array_keys(
      array_combine_key2($calificaciones, ["dis_asignatura", "dis_planificacion"])
    );

    $ids_d = array_keys($d);
    $ids_r = array_diff($ids_d, $ids_c);

    return array_intersect_key($d, array_flip($ids_r) );
  }

  public function disposicionesRestantesAnio($calificaciones, $disposiciones){

    return array_group_value(
      $this->disposicionesRestantes($calificaciones, $disposiciones), 
      "pla_anio"
    );
  }

  public function disposicionesPlanAnio($plan, $anio){
    /**
     * Disposiciones de plan y el anio ingreso
     */
    $render = $this->container->getRender("disposicion");

    $render->setCondition([
      ["pla-plan","=",$plan],
      ["pla-anio",">=",$anio]
    ]);
    $render->setOrder(["pla-anio"=>"asc","pla-semestre"=>"asc", "asi-nombre"=>"asc"]);
    
    return $this->container->getDb()->all("disposicion",$render);
  }

  public function cantidadCalificacionesAprobadas_($idAlumno_, $planificacion){
    $render = $this->container->getRender();
    $render->addCondition(["dis-planificacion","=",$planificacion]);
    $render->addCondition(["alumno","=",$idAlumno_]);
    $render->addCondition([
      ["nota_final",">=","7"],
      ["crec",">=","4","OR"]
    ]);
    $render->addFields(["alumno", "cantidad"=> "count"]);
    $render->setSize(0);
    $render->setGroup(["alumno"]);
    return $this->container->getDb()->select("calificacion",$render);
  }

  public function calificacionesAprobadasAlumnoPlan($idAlumno, $plan){
    $render = $this->container->getRender("calificacion");
    $render->setCondition([
      ["dis_pla-plan","=",$plan],
      ["alumno","=",$idAlumno],
      [
        ["nota_final",">=","7"],
        ["crec",">=","4","OR"],
      ]
    ]);
    $render->setOrder(["dis_pla-anio"=>"asc","dis_pla-semestre"=>"asc","dis_asi-nombre"=>"asc"]);
    return $this->container->getDb()->all("calificacion",$render);
  }

  public function calificacionesAlumnoPlanAnio($idAlumno, $plan, $anio){
    $render = $this->container->getRender("calificacion");
    $render->setCondition([
      ["dis_pla-plan","=",$plan],
      ["dis_pla-anio",">=",$anio],
      ["alumno","=",$idAlumno],
    ]);
    $render->setOrder(["dis_pla-anio"=>"asc","dis_pla-semestre"=>"asc","dis_asi-nombre"=>"asc"]);
    return $this->container->getDb()->all("calificacion",$render);
  }

  public function cantidadPlanificacionCalificacionesAprobadasAlumnoPlan($idAlumno, $plan){
    
    $render = $this->container->getRender("calificacion");
    $render->setCondition([
      ["dis_pla-plan","=",$plan],      
      ["alumno","=",$idAlumno],
      [
        ["nota_final",">=","7"],
        ["crec",">=","4","OR"],
      ]
    ]);
    $render->setFields(["anio"=>"dis_pla-anio","semestre"=>"dis_pla-semestre","cantidad"=> "count"]);
    $render->setSize(0);
    $render->setGroup(["anio"=>"dis_pla-anio","semestre"=>"dis_pla-semestre"]);
    $render->setOrder(["dis_pla-anio"=>"asc","dis_pla-semestre"=>"asc"]);
    return $this->container->getDb()->select("calificacion",$render);
  }

  public function cantidadAnioCalificacionesAprobadasAlumnoPlan($idAlumno, $plan, $anio = 1){
    /**
     * @return [
     *   [anio,cantidad]
     * ]
     **/   
    $render = $this->container->getRender("calificacion");
    $render->setCondition([
      ["dis_pla-plan","=",$plan],  
      ["dis_pla-anio",">=",$anio],      
      ["alumno","=",$idAlumno],
      [
        ["nota_final",">=","7"],
        ["crec",">=","4","OR"],
      ]
    ]);
    $render->setFields(["anio"=>"dis_pla-anio","cantidad"=> "count"]);
    $render->setSize(0);
    $render->setGroup(["anio"=>"dis_pla-anio"]);
    $render->setOrder(["dis_pla-anio"=>"asc"]);
    $render->setOrder(["dis_pla-semestre"=>"asc"]);
    return $this->container->getDb()->select("calificacion",$render);
  }



}