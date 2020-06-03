<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _SedeSqlo extends EntitySqlo {

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

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['coo_id'])){
      $json = EntitySql::getInstanceRequire('persona', 'coo')->_json($row);
      $row_["coordinador_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["sede"] = EntityValues::getInstanceRequire("sede", $row);
    $row_["coordinador"] = EntityValues::getInstanceRequire('persona', $row, 'coo_');
    return $row_;
  }



}
