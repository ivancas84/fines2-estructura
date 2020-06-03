<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _ComisionSqlo extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('comision');
    $this->sql = EntitySql::getInstanceRequire('comision');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "turno, " ;
    $sql .= "division, " ;
    $sql .= "comentario, " ;
    $sql .= "autorizada, " ;
    $sql .= "apertura, " ;
    $sql .= "publicada, " ;
    $sql .= "observaciones, " ;
    $sql .= "sede, " ;
    $sql .= "modalidad, " ;
    $sql .= "planificacion, " ;
    $sql .= "comision_siguiente, " ;
    $sql .= "calendario, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['turno'] . ", " ;
    $sql .= $row['division'] . ", " ;
    $sql .= $row['comentario'] . ", " ;
    $sql .= $row['autorizada'] . ", " ;
    $sql .= $row['apertura'] . ", " ;
    $sql .= $row['publicada'] . ", " ;
    $sql .= $row['observaciones'] . ", " ;
    $sql .= $row['sede'] . ", " ;
    $sql .= $row['modalidad'] . ", " ;
    $sql .= $row['planificacion'] . ", " ;
    $sql .= $row['comision_siguiente'] . ", " ;
    $sql .= $row['calendario'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['turno'] )) $sql .= "turno = " . $row['turno'] . " ," ;
    if (isset($row['division'] )) $sql .= "division = " . $row['division'] . " ," ;
    if (isset($row['comentario'] )) $sql .= "comentario = " . $row['comentario'] . " ," ;
    if (isset($row['autorizada'] )) $sql .= "autorizada = " . $row['autorizada'] . " ," ;
    if (isset($row['apertura'] )) $sql .= "apertura = " . $row['apertura'] . " ," ;
    if (isset($row['publicada'] )) $sql .= "publicada = " . $row['publicada'] . " ," ;
    if (isset($row['observaciones'] )) $sql .= "observaciones = " . $row['observaciones'] . " ," ;
    if (isset($row['sede'] )) $sql .= "sede = " . $row['sede'] . " ," ;
    if (isset($row['modalidad'] )) $sql .= "modalidad = " . $row['modalidad'] . " ," ;
    if (isset($row['planificacion'] )) $sql .= "planificacion = " . $row['planificacion'] . " ," ;
    if (isset($row['comision_siguiente'] )) $sql .= "comision_siguiente = " . $row['comision_siguiente'] . " ," ;
    if (isset($row['calendario'] )) $sql .= "calendario = " . $row['calendario'] . " ," ;
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

    $row_["comision"] = EntityValues::getInstanceRequire("comision", $row);
    return $row_;
  }



}
