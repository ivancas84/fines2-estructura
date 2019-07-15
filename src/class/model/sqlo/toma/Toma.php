<?php

require_once("class/model/sqlo/toma/Main.php");

//***** implementacion de Sqlo para una determinada tabla *****
class TomaSqlo extends TomaSqloMain{

 
    
    public function profesorSumaHorasCatedraAll($render = null){    
        $sql = $this->all($render);        
        return "
SELECT toma_.profesor AS profesor, SUM( toma_.cur_ch_horas_catedra ) AS suma_horas_catedra
FROM (
    {$sql}
) AS toma_
GROUP BY toma_.profesor
ORDER BY suma_horas_catedra DESC
";

        /* return "  SELECT id_persona.id, SUM( carga_horaria.horas_catedra ) AS horas_catedra
        FROM toma
        RIGHT JOIN curso ON ( curso.id = toma.curso )
        INNER JOIN comision ON ( curso.comision = comision.id )
        INNER JOIN division ON ( comision.division = division.id )
        INNER JOIN sede ON ( division.sede = sede.id )
        INNER JOIN carga_horaria ON ( curso.carga_horaria = carga_horaria.id )
        INNER JOIN id_persona ON ( toma.profesor = id_persona.id )
        WHERE toma.estado = 'Aprobada'
        AND comision.fecha = '" . $fecha . "'
        GROUP BY id_persona.id
";*/

    }
}
