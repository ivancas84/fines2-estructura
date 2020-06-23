<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _DetallePersonaSqlo extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('detalle_persona');
    $this->sql = EntitySql::getInstanceRequire('detalle_persona');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "descripcion, " ;
    $sql .= "creado, " ;
    $sql .= "archivo, " ;
    $sql .= "persona, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['descripcion'] . ", " ;
    $sql .= $row['creado'] . ", " ;
    $sql .= $row['archivo'] . ", " ;
    $sql .= $row['persona'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['descripcion'] )) $sql .= "descripcion = " . $row['descripcion'] . " ," ;
    if (isset($row['creado'] )) $sql .= "creado = " . $row['creado'] . " ," ;
    if (isset($row['archivo'] )) $sql .= "archivo = " . $row['archivo'] . " ," ;
    if (isset($row['persona'] )) $sql .= "persona = " . $row['persona'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['arc_id'])){
      $json = EntitySql::getInstanceRequire('file', 'arc')->_json($row);
      $row_["archivo_"] = $json;
    }
    if(!is_null($row['per_id'])){
      $json = EntitySql::getInstanceRequire('persona', 'per')->_json($row);
      $row_["persona_"] = $json;
    }
    if(!is_null($row['per_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'per_dom')->_json($row);
      $row_["persona_"]["domicilio_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["detalle_persona"] = EntityValues::getInstanceRequire("detalle_persona", $row);
    $row_["archivo"] = EntityValues::getInstanceRequire('file', $row, 'arc_');
    $row_["persona"] = EntityValues::getInstanceRequire('persona', $row, 'per_');
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $row, 'per_dom_');
    return $row_;
  }



}
