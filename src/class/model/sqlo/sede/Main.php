<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class SedeSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('sede');
    $this->sql = EntitySql::getInstanceRequire('sede');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "numero, " ;
    $sql .= "nombre, " ;
    $sql .= "organizacion, " ;
    $sql .= "observaciones, " ;
    $sql .= "tipo, " ;
    $sql .= "baja, " ;
    $sql .= "dependencia, " ;
    $sql .= "tipo_sede, " ;
    $sql .= "domicilio, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['numero'] . ", " ;
    $sql .= $row['nombre'] . ", " ;
    $sql .= $row['organizacion'] . ", " ;
    $sql .= $row['observaciones'] . ", " ;
    $sql .= $row['tipo'] . ", " ;
    $sql .= $row['baja'] . ", " ;
    $sql .= $row['dependencia'] . ", " ;
    $sql .= $row['tipo_sede'] . ", " ;
    $sql .= $row['domicilio'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['numero'] )) $sql .= "numero = " . $row['numero'] . " ," ;
    if (isset($row['nombre'] )) $sql .= "nombre = " . $row['nombre'] . " ," ;
    if (isset($row['organizacion'] )) $sql .= "organizacion = " . $row['organizacion'] . " ," ;
    if (isset($row['observaciones'] )) $sql .= "observaciones = " . $row['observaciones'] . " ," ;
    if (isset($row['tipo'] )) $sql .= "tipo = " . $row['tipo'] . " ," ;
    if (isset($row['baja'] )) $sql .= "baja = " . $row['baja'] . " ," ;
    if (isset($row['dependencia'] )) $sql .= "dependencia = " . $row['dependencia'] . " ," ;
    if (isset($row['tipo_sede'] )) $sql .= "tipo_sede = " . $row['tipo_sede'] . " ," ;
    if (isset($row['domicilio'] )) $sql .= "domicilio = " . $row['domicilio'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['ts_id'])){
      $json = EntitySql::getInstanceRequire('tipo_sede', 'ts')->_json($row);
      $row_["tipo_sede_"] = $json;
    }
    if(!is_null($row['dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'dom')->_json($row);
      $row_["domicilio_"] = $json;
    }
    if(!is_null($row['coo_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'coo')->_json($row);
      $row_["coordinador_"] = $json;
    }
    if(!is_null($row['ref_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'ref')->_json($row);
      $row_["referente_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $json = ($row && !is_null($row['id'])) ? $this->sql->_json($row) : null;
    $row_["sede"] = EntityValues::getInstanceRequire("sede", $json);

    $json = ($row && !is_null($row['ts_id'])) ? EntitySql::getInstanceRequire('tipo_sede', 'ts')->_json($row) : null;
    $row_["tipo_sede"] = EntityValues::getInstanceRequire('tipo_sede', $json);

    $json = ($row && !is_null($row['dom_id'])) ? EntitySql::getInstanceRequire('domicilio', 'dom')->_json($row) : null;
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $json);

    $json = ($row && !is_null($row['coo_id'])) ? EntitySql::getInstanceRequire('id_persona', 'coo')->_json($row) : null;
    $row_["coordinador"] = EntityValues::getInstanceRequire('id_persona', $json);

    $json = ($row && !is_null($row['ref_id'])) ? EntitySql::getInstanceRequire('id_persona', 'ref')->_json($row) : null;
    $row_["referente"] = EntityValues::getInstanceRequire('id_persona', $json);

    return $row_;
  }



}
