<?php

require_once("class/model/sqlo/toma/Main.php");

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

    }
}
