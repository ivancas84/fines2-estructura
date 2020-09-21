<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _EmailFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function email() { return $this->mapping->email() . " AS " . $this->_pf() . "email"; }
  public function verificado() { return $this->mapping->verificado() . " AS " . $this->_pf() . "verificado"; }
  public function insertado() { return $this->mapping->insertado() . " AS " . $this->_pf() . "insertado"; }
  public function insertadoDate() { return $this->mapping->insertadoDate() . " AS " . $this->_pf() . "insertado_date"; }
  public function insertadoYm() { return $this->mapping->insertadoYm() . " AS " . $this->_pf() . "insertado_ym"; }
  public function insertadoY() { return $this->mapping->insertadoY() . " AS " . $this->_pf() . "insertado_y"; }
  public function eliminado() { return $this->mapping->eliminado() . " AS " . $this->_pf() . "eliminado"; }
  public function eliminadoDate() { return $this->mapping->eliminadoDate() . " AS " . $this->_pf() . "eliminado_date"; }
  public function eliminadoYm() { return $this->mapping->eliminadoYm() . " AS " . $this->_pf() . "eliminado_ym"; }
  public function eliminadoY() { return $this->mapping->eliminadoY() . " AS " . $this->_pf() . "eliminado_y"; }
  public function persona() { return $this->mapping->persona() . " AS " . $this->_pf() . "persona"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function minEmail() { return $this->mapping->minEmail() . " AS " . $this->_pf() . "min_email"; }
  public function maxEmail() { return $this->mapping->maxEmail() . " AS " . $this->_pf() . "max_email"; }
  public function countEmail() { return $this->mapping->countEmail() . " AS " . $this->_pf() . "count_email"; }

  public function minVerificado() { return $this->mapping->minVerificado() . " AS " . $this->_pf() . "min_verificado"; }
  public function maxVerificado() { return $this->mapping->maxVerificado() . " AS " . $this->_pf() . "max_verificado"; }
  public function countVerificado() { return $this->mapping->countVerificado() . " AS " . $this->_pf() . "count_verificado"; }

  public function avgInsertado() { return $this->mapping->avgInsertado() . " AS " . $this->_pf() . "avg_insertado"; }
  public function minInsertado() { return $this->mapping->minInsertado() . " AS " . $this->_pf() . "min_insertado"; }
  public function maxInsertado() { return $this->mapping->maxInsertado() . " AS " . $this->_pf() . "max_insertado"; }
  public function countInsertado() { return $this->mapping->countInsertado() . " AS " . $this->_pf() . "count_insertado"; }

  public function avgEliminado() { return $this->mapping->avgEliminado() . " AS " . $this->_pf() . "avg_eliminado"; }
  public function minEliminado() { return $this->mapping->minEliminado() . " AS " . $this->_pf() . "min_eliminado"; }
  public function maxEliminado() { return $this->mapping->maxEliminado() . " AS " . $this->_pf() . "max_eliminado"; }
  public function countEliminado() { return $this->mapping->countEliminado() . " AS " . $this->_pf() . "count_eliminado"; }

  public function minPersona() { return $this->mapping->minPersona() . " AS " . $this->_pf() . "min_persona"; }
  public function maxPersona() { return $this->mapping->maxPersona() . " AS " . $this->_pf() . "max_persona"; }
  public function countPersona() { return $this->mapping->countPersona() . " AS " . $this->_pf() . "count_persona"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
