<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _TomaSqlo extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('toma');
    $this->sql = EntitySql::getInstanceRequire('toma');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "fecha_toma, " ;
    $sql .= "estado, " ;
    $sql .= "observaciones, " ;
    $sql .= "comentario, " ;
    $sql .= "tipo_movimiento, " ;
    $sql .= "estado_contralor, " ;
    $sql .= "alta, " ;
    $sql .= "curso, " ;
    $sql .= "docente, " ;
    $sql .= "reemplazo, " ;
    $sql .= "planilla_docente, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['fecha_toma'] . ", " ;
    $sql .= $row['estado'] . ", " ;
    $sql .= $row['observaciones'] . ", " ;
    $sql .= $row['comentario'] . ", " ;
    $sql .= $row['tipo_movimiento'] . ", " ;
    $sql .= $row['estado_contralor'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql .= $row['curso'] . ", " ;
    $sql .= $row['docente'] . ", " ;
    $sql .= $row['reemplazo'] . ", " ;
    $sql .= $row['planilla_docente'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['fecha_toma'] )) $sql .= "fecha_toma = " . $row['fecha_toma'] . " ," ;
    if (isset($row['estado'] )) $sql .= "estado = " . $row['estado'] . " ," ;
    if (isset($row['observaciones'] )) $sql .= "observaciones = " . $row['observaciones'] . " ," ;
    if (isset($row['comentario'] )) $sql .= "comentario = " . $row['comentario'] . " ," ;
    if (isset($row['tipo_movimiento'] )) $sql .= "tipo_movimiento = " . $row['tipo_movimiento'] . " ," ;
    if (isset($row['estado_contralor'] )) $sql .= "estado_contralor = " . $row['estado_contralor'] . " ," ;
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    if (isset($row['curso'] )) $sql .= "curso = " . $row['curso'] . " ," ;
    if (isset($row['docente'] )) $sql .= "docente = " . $row['docente'] . " ," ;
    if (isset($row['reemplazo'] )) $sql .= "reemplazo = " . $row['reemplazo'] . " ," ;
    if (isset($row['planilla_docente'] )) $sql .= "planilla_docente = " . $row['planilla_docente'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["toma"] = EntityValues::getInstanceRequire("toma", $row);
    return $row_;
  }



}
