<?php


class ComisionDiasHorarios  {

    public function main(array $ids_comision){
        $ids_comision_ = implode("','", $ids_comision);

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
            WHERE comision.id IN ('{$ids_comision_}')
            ORDER BY dia.numero
        ) AS dias_
        GROUP BY comision
        
        
        ) AS dias ON (dias.comision = comision.id)
        INNER JOIN (


        SELECT DISTINCT comision.id AS comision, MIN(horario.hora_inicio) AS hora_inicio, MAX(horario.hora_fin) AS hora_fin
        FROM horario
        INNER JOIN curso ON (curso.id = horario.curso)
        INNER JOIN comision ON (comision.id = curso.comision)
        WHERE comision.id IN ('{$ids_comision_}')    
        GROUP BY comision
        
        
        ) AS horas ON (horas.comision = comision.id)
        
    ";

        $result = $this->container->db()->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        return $rows;
    }
}