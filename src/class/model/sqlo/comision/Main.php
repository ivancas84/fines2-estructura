<?php

require_once("class/model/Sqlo.php");

//Implementacion principal de Sqlo para una entidad especifica
class ComisionSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceFromString('comision');
    $this->sql = EntitySql::getInstanceFromString('comision');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "anio, " ;
    $sql .= "semestre, " ;
    $sql .= "observaciones, " ;
    $sql .= "comentario, " ;
    $sql .= "autorizada, " ;
    $sql .= "apertura, " ;
    $sql .= "publicar, " ;
    $sql .= "fecha_anio, " ;
    $sql .= "fecha_semestre, " ;
    $sql .= "comision_siguiente, " ;
    $sql .= "division, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['anio'] . ", " ;
    $sql .= $row['semestre'] . ", " ;
    $sql .= $row['observaciones'] . ", " ;
    $sql .= $row['comentario'] . ", " ;
    $sql .= $row['autorizada'] . ", " ;
    $sql .= $row['apertura'] . ", " ;
    $sql .= $row['publicar'] . ", " ;
    $sql .= $row['fecha_anio'] . ", " ;
    $sql .= $row['fecha_semestre'] . ", " ;
    $sql .= $row['comision_siguiente'] . ", " ;
    $sql .= $row['division'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['anio'] )) $sql .= "anio = " . $row['anio'] . " ," ;
    if (isset($row['semestre'] )) $sql .= "semestre = " . $row['semestre'] . " ," ;
    if (isset($row['observaciones'] )) $sql .= "observaciones = " . $row['observaciones'] . " ," ;
    if (isset($row['comentario'] )) $sql .= "comentario = " . $row['comentario'] . " ," ;
    if (isset($row['autorizada'] )) $sql .= "autorizada = " . $row['autorizada'] . " ," ;
    if (isset($row['apertura'] )) $sql .= "apertura = " . $row['apertura'] . " ," ;
    if (isset($row['publicar'] )) $sql .= "publicar = " . $row['publicar'] . " ," ;
    if (isset($row['fecha_anio'] )) $sql .= "fecha_anio = " . $row['fecha_anio'] . " ," ;
    if (isset($row['fecha_semestre'] )) $sql .= "fecha_semestre = " . $row['fecha_semestre'] . " ," ;
    if (isset($row['comision_siguiente'] )) $sql .= "comision_siguiente = " . $row['comision_siguiente'] . " ," ;
    if (isset($row['division'] )) $sql .= "division = " . $row['division'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['dvi_id'])){
      $json = EntitySql::getInstanceFromString('division', 'dvi')->_json($row);
      $row_["division_"] = $json;
    }
    if(!is_null($row['dvi_pla_id'])){
      $json = EntitySql::getInstanceFromString('plan', 'dvi_pla')->_json($row);
      $row_["division_"]["plan_"] = $json;
    }
    if(!is_null($row['dvi_sed_id'])){
      $json = EntitySql::getInstanceFromString('sede', 'dvi_sed')->_json($row);
      $row_["division_"]["sede_"] = $json;
    }
    if(!is_null($row['dvi_sed_ts_id'])){
      $json = EntitySql::getInstanceFromString('tipo_sede', 'dvi_sed_ts')->_json($row);
      $row_["division_"]["sede_"]["tipo_sede_"] = $json;
    }
    if(!is_null($row['dvi_sed_dom_id'])){
      $json = EntitySql::getInstanceFromString('domicilio', 'dvi_sed_dom')->_json($row);
      $row_["division_"]["sede_"]["domicilio_"] = $json;
    }
    if(!is_null($row['dvi_sed_coo_id'])){
      $json = EntitySql::getInstanceFromString('id_persona', 'dvi_sed_coo')->_json($row);
      $row_["division_"]["sede_"]["coordinador_"] = $json;
    }
    if(!is_null($row['dvi_sed_ref_id'])){
      $json = EntitySql::getInstanceFromString('id_persona', 'dvi_sed_ref')->_json($row);
      $row_["division_"]["sede_"]["referente_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $json = ($row && !is_null($row['id'])) ? $this->sql->_json($row) : null;
    $row_["comision"] = EntityValues::getInstanceFromString("comision", $json);

    $json = ($row && !is_null($row['dvi_id'])) ? EntitySql::getInstanceFromString('division', 'dvi')->_json($row) : null;
    $row_["division"] = EntityValues::getInstanceFromString('division', $json);

    $json = ($row && !is_null($row['dvi_pla_id'])) ? EntitySql::getInstanceFromString('plan', 'dvi_pla')->_json($row) : null;
    $row_["plan"] = EntityValues::getInstanceFromString('plan', $json);

    $json = ($row && !is_null($row['dvi_sed_id'])) ? EntitySql::getInstanceFromString('sede', 'dvi_sed')->_json($row) : null;
    $row_["sede"] = EntityValues::getInstanceFromString('sede', $json);

    $json = ($row && !is_null($row['dvi_sed_ts_id'])) ? EntitySql::getInstanceFromString('tipo_sede', 'dvi_sed_ts')->_json($row) : null;
    $row_["tipo_sede"] = EntityValues::getInstanceFromString('tipo_sede', $json);

    $json = ($row && !is_null($row['dvi_sed_dom_id'])) ? EntitySql::getInstanceFromString('domicilio', 'dvi_sed_dom')->_json($row) : null;
    $row_["domicilio"] = EntityValues::getInstanceFromString('domicilio', $json);

    $json = ($row && !is_null($row['dvi_sed_coo_id'])) ? EntitySql::getInstanceFromString('id_persona', 'dvi_sed_coo')->_json($row) : null;
    $row_["coordinador"] = EntityValues::getInstanceFromString('id_persona', $json);

    $json = ($row && !is_null($row['dvi_sed_ref_id'])) ? EntitySql::getInstanceFromString('id_persona', 'dvi_sed_ref')->_json($row) : null;
    $row_["referente"] = EntityValues::getInstanceFromString('id_persona', $json);

    return $row_;
  }



}
