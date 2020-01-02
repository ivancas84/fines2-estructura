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
    $sql .= "observaciones, " ;
    $sql .= "baja, " ;
    $sql .= "domicilio, " ;
    $sql .= "tipo_sede, " ;
    $sql .= "centro_educativo, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['numero'] . ", " ;
    $sql .= $row['nombre'] . ", " ;
    $sql .= $row['observaciones'] . ", " ;
    $sql .= $row['baja'] . ", " ;
    $sql .= $row['domicilio'] . ", " ;
    $sql .= $row['tipo_sede'] . ", " ;
    $sql .= $row['centro_educativo'] . ", " ;
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
    if (isset($row['observaciones'] )) $sql .= "observaciones = " . $row['observaciones'] . " ," ;
    if (isset($row['baja'] )) $sql .= "baja = " . $row['baja'] . " ," ;
    if (isset($row['domicilio'] )) $sql .= "domicilio = " . $row['domicilio'] . " ," ;
    if (isset($row['tipo_sede'] )) $sql .= "tipo_sede = " . $row['tipo_sede'] . " ," ;
    if (isset($row['centro_educativo'] )) $sql .= "centro_educativo = " . $row['centro_educativo'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'dom')->_json($row);
      $row_["domicilio_"] = $json;
    }
    if(!is_null($row['ts_id'])){
      $json = EntitySql::getInstanceRequire('tipo_sede', 'ts')->_json($row);
      $row_["tipo_sede_"] = $json;
    }
    if(!is_null($row['ce_id'])){
      $json = EntitySql::getInstanceRequire('centro_educativo', 'ce')->_json($row);
      $row_["centro_educativo_"] = $json;
    }
    if(!is_null($row['ce_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'ce_dom')->_json($row);
      $row_["centro_educativo_"]["domicilio_"] = $json;
    }
    if(!is_null($row['coo_id'])){
      $json = EntitySql::getInstanceRequire('persona', 'coo')->_json($row);
      $row_["coordinador_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["sede"] = EntityValues::getInstanceRequire("sede", $row);
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $row, 'dom_');
    $row_["tipo_sede"] = EntityValues::getInstanceRequire('tipo_sede', $row, 'ts_');
    $row_["centro_educativo"] = EntityValues::getInstanceRequire('centro_educativo', $row, 'ce_');
    $row_["domicilio1"] = EntityValues::getInstanceRequire('domicilio', $row, 'ce_dom_');
    $row_["coordinador"] = EntityValues::getInstanceRequire('persona', $row, 'coo_');
    return $row_;
  }



}
