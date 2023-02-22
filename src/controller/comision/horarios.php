<?php

require_once("function/array_combine_keys.php");
require_once("function/array_combine_key.php");


class ComisionHorarios  {

    public function cantidad_horarios($id_comision){
        return $this->container->query("horario")
        ->cond(["comision-id","=", $id_comision])
        ->size(0)->page(1)->fields(["count"])->columnOne();
    }


    /**
     * las asignaturas de los cursos deben coincidir con los de las distribuciones horarias
     * sin embargo la comision puede tener cursos adicionales los cuales no seran considerados
     * la comision no puede tener dos cursos referidos a la misma asignatura, se efectuara un error al combinar
     */
    public function generar_horarios_sql(string $id_comision, string $hora_inicio, array $dias) {
        

        //verificar si la comision tiene horarios
        $h = $this->cantidad_horarios($id_comision);
        if(intval($h)) throw new Exception("Ya existen horarios para la comision " . $id_comision);
      
        //consultar cursos y agruparlos por asignatura
        $cursos = $this->container->query("curso")->cond(["comision","=", $id_comision])->fields()->all();  
        if(empty($cursos)) throw new Exception("No existen cursos para la comision " . $id_comision);
        $cursos_asignatura = array_combine_key($cursos,"asignatura");

        //asignar un orden aleatorio a los dias
        if(!shuffle($dias)) throw new Exception("No se pudo asignar un orden aleatorio a los días");

        //consultar distribuciones horarias
        $distribuciones_horarias = $this->container->query("distribucion_horaria")
        ->cond(["planificacion-id", EQUAL, $cursos[0]["planificacion-id"]])
        ->fields()->all();

        if(empty($distribuciones_horarias)) throw new Exception("No existen distribuciones horarias para la comision indicada: " . $id_comision);
        if(!shuffle($distribuciones_horarias)) throw new Exception("No se pudo asignar orden aleatorio a la distribucion horaria");
        if(
          count(array_unique(array_column($distribuciones_horarias, "dia"))) 
          != count($dias)
        ) throw new Exception("La cantidad de dias de la distribucion horaria no coincide con la cantidad de dias definidos en comision: " . $id_comision);  

        $cargas_horarias_asignatura = $this->container->controller("cargas_horarias_asignatura","distribucion_horaria")->main($distribuciones_horarias);

        foreach($cargas_horarias_asignatura as $id_asignatura => $horas_catedras){
          $curso = $cursos_asignatura[$id_asignatura];
          if(intval($horas_catedras) != intval($curso["horas_catedra"])) throw new Exception("No coincide la carga horaria obtenida de la distribucion horaria con las horas catedra del curso en comision " . $id_comision . " para el curso " . $curso["id"]);
        }
      
        $horas_catedras_dia = [];
        $detail = [];
        $sql = "";
        foreach($distribuciones_horarias as $dh){
            $horario = $this->container->value("horario"); 
            
            $hora = DateTime::createFromFormat("H:i", $hora_inicio); 
            if(!$hora) $hora = DateTime::createFromFormat("H:i:s", $hora_inicio); 
            
            if(!key_exists($dh["dia"], $horas_catedras_dia)) $horas_catedras_dia[$dh["dia"]] = 0;
            $minutos = $horas_catedras_dia[$dh["dia"]];

            $hora->modify("+{$minutos} minute");
            $horario->_fastSet("hora_inicio", clone $hora);

            $minutos = intval($dh["horas_catedra"]) * 40;
            $hora->modify("+{$minutos} minute");
            $horario->_fastSet("hora_fin", clone $hora);

            $horas_catedras_dia[$dh["dia"]] += $minutos;
            
            $horario->_fastSet("dia", $dias[intval($dh["dia"])-1]);
            $horario->_fastSet("curso", $cursos_asignatura[$dh["asignatura-id"]]["id"]);

            $persist = $this->container->controller("persist_sql_value","horario")->id($horario);
            array_push($detail,"horario".$persist["id"]);
            $sql .= $persist["sql"];
        }

        return ["id" => $id_comision, "detail" => $detail, "sql"=>$sql];
    }

    
    public function dias_horarios(array $ids_comision){
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


    public function generar_horarios_siguiente(array $ids_comision){
        $comisiones = $this->container->query("comision")->cond([
            ["id", EQUAL, $ids_comision],
            ["comision_siguiente", EQUAL,true]
        ])->fields()->all();

        $ids_comision_ = array_column($comisiones, "id"); //si la lista inicial contiene comisiones sin siguientes vuelvo a filtrar
        
        $comisiones_horarios = $this->container->controller("horarios","comision")->dias_horarios($ids_comision_);
        $comisiones_horarios = array_combine_key($comisiones_horarios, "comision");

        $response = [];
        foreach($comisiones as $comision){
            try {
                if(!array_key_exists($comision["id"], $comisiones_horarios)) throw new Exception("La comision no tiene horarios");
                $dias = explode(",",$comisiones_horarios[$comision["id"]]["dias_ids"]);
                $hora_inicio = $comisiones_horarios[$comision["id"]]["hora_inicio"];
                $r = $this->container->controller("horarios", "comision")->generar_horarios_sql($comision["comision_siguiente"],$hora_inicio,$dias);
                $r["id"] = $comision["id"];
                $this->container->db()->multi_query_transaction($r["sql"]);
            } catch (Exception $ex){
                $r = [
                    "id" => $comision["id"],
                    "error" => $ex->getMessage()
                ];
            }

            array_push($response,$r);
        }

        return $response;

        
    }
    


}




