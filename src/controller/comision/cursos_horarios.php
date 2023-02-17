<?php


class ComisionCursosHorarios  {

    public function main(array $ids_comision){
        $sql = "
  SELECT curso.id AS curso, GROUP_CONCAT(dia.dia, \" \", TIME_FORMAT(horario.hora_inicio, '%H:%i'), \" a \", TIME_FORMAT(horario.hora_fin, '%H:%i') ORDER BY dia.numero ASC SEPARATOR ', ') AS horario
  FROM curso
  INNER JOIN horario ON (horario.curso = curso.id)
  INNER JOIN dia ON (dia.id = horario.dia)
  WHERE curso.comision IN ('". implode("' ,'" , $ids_comision) . "')
  GROUP BY curso.id
  ";

        $result = $this->container->db()->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        return $rows;
    }
}