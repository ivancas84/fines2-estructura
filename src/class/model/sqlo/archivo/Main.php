<?php

require_once("class/model/Sqlo.php");
require_once("class/db/SqlFormat.php");

//Implementacion principal de Sqlo para una entidad especifica
class ArchivoSqloMain extends EntitySqlo {

  //Constructor
  //Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
  public function __construct(){
    $this->entity = new ArchivoEntity;
    $this->sql = new ArchivoSql($this->entity);
  }

  //@override
  protected function _insert(array $row){
    $sql = "
INSERT INTO " . $this->entity->sn_() . " (";
    $sql .= "id, " ;
    $sql .= "nombre, " ;
    $sql .= "archivo, " ;
    $sql .= "tipo, " ;
    $sql .= "tamanio, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma    

    $sql .= ") 
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['nombre'] . ", " ;
    $sql .= $row['archivo'] . ", " ;
    $sql .= $row['tipo'] . ", " ;
    $sql .= $row['tamanio'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma    

    $sql .= ");
";
  
    return $sql;
  }

  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : $this->nextPk();
    if(empty($data['nombre'])) throw new Exception('dato obligatorio sin valor: nombre');
    if(empty($data['archivo'])) $data['archivo'] = "null";
    if(empty($data['tipo'])) $data['tipo'] = "null";
    if(!isset($data['tamanio']) || ($data['tamanio'] == '')) $data['tamanio'] = "null";

    return $data;
  }

  //@override
  protected function _update(array $row){
    $sql = "
UPDATE " . $this->entity->sn_() . " SET 
"; 
    if (isset($row['nombre'] )) $sql .= "nombre = " . $row['nombre'] . " ," ;
    if (isset($row['archivo'] )) $sql .= "archivo = " . $row['archivo'] . " ," ;
    if (isset($row['tipo'] )) $sql .= "tipo = " . $row['tipo'] . " ," ;
    if (isset($row['tamanio'] )) $sql .= "tamanio = " . $row['tamanio'] . " ," ;
    //eliminar ultima coma    
    $sql = substr($sql, 0, -2);

        
    $sql .= "
WHERE id = " . $row['id'] . ";
"; 
  
    return $sql;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('nombre', $data)) { if(empty($data['nombre'])) throw new Exception('dato obligatorio sin valor: nombre'); }
    if(array_key_exists('archivo', $data)) { if(empty($data['archivo'])) $data['archivo'] = "null"; }
    if(array_key_exists('tipo', $data)) { if(empty($data['tipo'])) $data['tipo'] = "null"; }
    if(array_key_exists('tamanio', $data)) { if(!isset($data['tamanio']) || ($data['tamanio'] == '')) $data['tamanio'] = "null"; }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $this->sql = new SqlFormat($this->db);
    $row_ = array();
    $row_['id'] = $this->sql->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['nombre'])) $row_['nombre'] = $this->sql->escapeString($row['nombre']);
    if(isset($row['archivo'])) $row_['archivo'] = $this->sql->escapeString($row['archivo']);
    if(isset($row['tipo'])) $row_['tipo'] = $this->sql->escapeString($row['tipo']);
    if(isset($row['tamanio'])) $row_['tamanio'] = $this->sql->numeric($row['tamanio']);

    return $row_;
  }

  //@override
  protected function _build(array $row, $prefix = ""){
    if(empty($row)) return null;
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : intval($row[$prefix . "id"]);
    $row_["nombre"] = (is_null($row[$prefix . "nombre"])) ? null : (string)$row[$prefix . "nombre"];
    $row_["archivo"] = (is_null($row[$prefix . "archivo"])) ? null : (string)$row[$prefix . "archivo"];
    $row_["tipo"] = (is_null($row[$prefix . "tipo"])) ? null : (string)$row[$prefix . "tipo"];
    $row_["tamanio"] = (is_null($row[$prefix . "tamanio"])) ? null : intval($row[$prefix . "tamanio"]);
    return $row_;
  }
  

}
