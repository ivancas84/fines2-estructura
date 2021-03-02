<?php

require_once("class/model/Render.php");
require_once("class/model/Ma.php");

class ModelTools {
  public $container;

  public function distribucionesHorarias($planificacion){
    if(empty($planificacion)) throw new Exception("Planificacion vacia");
    return $this->getDb()->all("distribucion_horaria", ["planificacion"=>$planificacion]);
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
    $render->setParams(["planificacion" => $planificacion]);
    $render->setFields(["horas_catedra.sum"]);
    $render->setGroup(["planificacion", "asignatura"]);
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
      if(!array_key_exists($dh["asignatura"], $cargasHorariasXAsignatura)) $cargasHorariasXAsignatura[$dh["asignatura"]] = 0;
      $cargasHorariasXAsignatura[$dh["asignatura"]] += intval($dh["horas_catedra"]);
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
WHERE (toma.estado = 'Aprobada' OR toma.estado = 'Pendiente') AND (toma.estado_contralor != 'Modificar')
AND curso.id IN ('{$idCursos_}')
";
  }

  public function cursoHorario($idCursos){
    $idCursos_ = implode("','",$idCursos);
    
    $sql = "
SELECT curso.id AS curso, GROUP_CONCAT(dia.dia, \" \", TIME_FORMAT(horario.hora_inicio, '%H:%i'), \" a \", TIME_FORMAT(horario.hora_fin, '%H:%i') ORDER BY dia.numero ASC SEPARATOR ', ') AS horario
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


}