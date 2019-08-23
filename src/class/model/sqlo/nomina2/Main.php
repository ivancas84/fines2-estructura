<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");

//Implementacion principal de Sqlo para una entidad especifica
class Nomina2SqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('nomina2');
    $this->sql = EntitySql::getInstanceRequire('nomina2');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "fotocopia_documento, " ;
    $sql .= "partida_nacimiento, " ;
    $sql .= "alta, " ;
    $sql .= "constancia_cuil, " ;
    $sql .= "certificado_estudios, " ;
    $sql .= "anio_ingreso, " ;
    $sql .= "activo, " ;
    $sql .= "programa, " ;
    $sql .= "observaciones, " ;
    $sql .= "persona, " ;
    $sql .= "comision, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['fotocopia_documento'] . ", " ;
    $sql .= $row['partida_nacimiento'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql .= $row['constancia_cuil'] . ", " ;
    $sql .= $row['certificado_estudios'] . ", " ;
    $sql .= $row['anio_ingreso'] . ", " ;
    $sql .= $row['activo'] . ", " ;
    $sql .= $row['programa'] . ", " ;
    $sql .= $row['observaciones'] . ", " ;
    $sql .= $row['persona'] . ", " ;
    $sql .= $row['comision'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['fotocopia_documento'] )) $sql .= "fotocopia_documento = " . $row['fotocopia_documento'] . " ," ;
    if (isset($row['partida_nacimiento'] )) $sql .= "partida_nacimiento = " . $row['partida_nacimiento'] . " ," ;
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    if (isset($row['constancia_cuil'] )) $sql .= "constancia_cuil = " . $row['constancia_cuil'] . " ," ;
    if (isset($row['certificado_estudios'] )) $sql .= "certificado_estudios = " . $row['certificado_estudios'] . " ," ;
    if (isset($row['anio_ingreso'] )) $sql .= "anio_ingreso = " . $row['anio_ingreso'] . " ," ;
    if (isset($row['activo'] )) $sql .= "activo = " . $row['activo'] . " ," ;
    if (isset($row['programa'] )) $sql .= "programa = " . $row['programa'] . " ," ;
    if (isset($row['observaciones'] )) $sql .= "observaciones = " . $row['observaciones'] . " ," ;
    if (isset($row['persona'] )) $sql .= "persona = " . $row['persona'] . " ," ;
    if (isset($row['comision'] )) $sql .= "comision = " . $row['comision'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['per_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'per')->_json($row);
      $row_["persona_"] = $json;
    }
    if(!is_null($row['com_id'])){
      $json = EntitySql::getInstanceRequire('comision', 'com')->_json($row);
      $row_["comision_"] = $json;
    }
    if(!is_null($row['com_dvi_id'])){
      $json = EntitySql::getInstanceRequire('division', 'com_dvi')->_json($row);
      $row_["comision_"]["division_"] = $json;
    }
    if(!is_null($row['com_dvi_pla_id'])){
      $json = EntitySql::getInstanceRequire('plan', 'com_dvi_pla')->_json($row);
      $row_["comision_"]["division_"]["plan_"] = $json;
    }
    if(!is_null($row['com_dvi_sed_id'])){
      $json = EntitySql::getInstanceRequire('sede', 'com_dvi_sed')->_json($row);
      $row_["comision_"]["division_"]["sede_"] = $json;
    }
    if(!is_null($row['com_dvi_sed_ts_id'])){
      $json = EntitySql::getInstanceRequire('tipo_sede', 'com_dvi_sed_ts')->_json($row);
      $row_["comision_"]["division_"]["sede_"]["tipo_sede_"] = $json;
    }
    if(!is_null($row['com_dvi_sed_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'com_dvi_sed_dom')->_json($row);
      $row_["comision_"]["division_"]["sede_"]["domicilio_"] = $json;
    }
    if(!is_null($row['com_dvi_sed_coo_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'com_dvi_sed_coo')->_json($row);
      $row_["comision_"]["division_"]["sede_"]["coordinador_"] = $json;
    }
    if(!is_null($row['com_dvi_sed_ref_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'com_dvi_sed_ref')->_json($row);
      $row_["comision_"]["division_"]["sede_"]["referente_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $json = ($row && !is_null($row['id'])) ? $this->sql->_json($row) : null;
    $row_["nomina2"] = EntityValues::getInstanceRequire("nomina2", $json);

    $json = ($row && !is_null($row['per_id'])) ? EntitySql::getInstanceRequire('id_persona', 'per')->_json($row) : null;
    $row_["persona"] = EntityValues::getInstanceRequire('id_persona', $json);

    $json = ($row && !is_null($row['com_id'])) ? EntitySql::getInstanceRequire('comision', 'com')->_json($row) : null;
    $row_["comision"] = EntityValues::getInstanceRequire('comision', $json);

    $json = ($row && !is_null($row['com_dvi_id'])) ? EntitySql::getInstanceRequire('division', 'com_dvi')->_json($row) : null;
    $row_["division"] = EntityValues::getInstanceRequire('division', $json);

    $json = ($row && !is_null($row['com_dvi_pla_id'])) ? EntitySql::getInstanceRequire('plan', 'com_dvi_pla')->_json($row) : null;
    $row_["plan"] = EntityValues::getInstanceRequire('plan', $json);

    $json = ($row && !is_null($row['com_dvi_sed_id'])) ? EntitySql::getInstanceRequire('sede', 'com_dvi_sed')->_json($row) : null;
    $row_["sede"] = EntityValues::getInstanceRequire('sede', $json);

    $json = ($row && !is_null($row['com_dvi_sed_ts_id'])) ? EntitySql::getInstanceRequire('tipo_sede', 'com_dvi_sed_ts')->_json($row) : null;
    $row_["tipo_sede"] = EntityValues::getInstanceRequire('tipo_sede', $json);

    $json = ($row && !is_null($row['com_dvi_sed_dom_id'])) ? EntitySql::getInstanceRequire('domicilio', 'com_dvi_sed_dom')->_json($row) : null;
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $json);

    $json = ($row && !is_null($row['com_dvi_sed_coo_id'])) ? EntitySql::getInstanceRequire('id_persona', 'com_dvi_sed_coo')->_json($row) : null;
    $row_["coordinador"] = EntityValues::getInstanceRequire('id_persona', $json);

    $json = ($row && !is_null($row['com_dvi_sed_ref_id'])) ? EntitySql::getInstanceRequire('id_persona', 'com_dvi_sed_ref')->_json($row) : null;
    $row_["referente"] = EntityValues::getInstanceRequire('id_persona', $json);

    return $row_;
  }



}
