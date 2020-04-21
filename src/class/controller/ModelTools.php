<?php

require_once("class/model/db/Dba.php");
require_once("class/model/Render.php");
require_once("class/model/Ma.php");



class ModelTools {

  public static function sumaHorasCatedraAsignaturasGrupo($fechaAnio, $fechaSemestre, $modalidad, $centroEducativo){
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

    return Ma::advanced("curso",$render);
  }

  public static function cargasHorarias($plan, $anio, $semestre){
    $params = [
      "plan" => $plan,
      "anio" => $anio,
      "semestre" => $semestre,
    ];

    $render = Render::getInstanceParams($params);
    $render->setAggregate(["sum_horas_catedra"]);
    $render->setGroup(["plan", "anio", "semestre", "asignatura"]);
    $render->setOrder(["sum_horas_catedra" => "desc"]);

    return Ma::advanced("distribucion_horaria",$render);
  }

  public static function intervaloAnterior(array $grupo){
    /**
     * un intervalo es la combinación de fecha_anio, fecha_semestre
     * @param $grupo["fecha_anio"]
     * @param $grupo["fecha_semestre"]
     */
    $param = $grupo;

    $param["fecha_anio"] = intval($grupo["fecha_anio"]);
    $param["fecha_semestre"] = intval($grupo["fecha_semestre"]);

    switch($param["fecha_semestre"]){
      case 2:  
        $param["fecha_semestre"] = 1; 
      break;
      
      case 1: 
        $param["fecha_anio"]--;
        $param["fecha_semestre"] = 2; 
      break;
      
      default: 
        $param["fecha_semestre"] = false;
        $param["fecha_anio"]--;
    }

    return $param;
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

    return Dba::fetchAll($sql);    
  }
}