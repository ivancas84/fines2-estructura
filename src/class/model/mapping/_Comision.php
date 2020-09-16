<?php
require_once("class/model/entityOptions/Mapping.php");

class _ComisionMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function turno() { return $this->_pt() . ".turno"; }
  public function division() { return $this->_pt() . ".division"; }
  public function comentario() { return $this->_pt() . ".comentario"; }
  public function autorizada() { return $this->_pt() . ".autorizada"; }
  public function apertura() { return $this->_pt() . ".apertura"; }
  public function publicada() { return $this->_pt() . ".publicada"; }
  public function observaciones() { return $this->_pt() . ".observaciones"; }
  public function alta() { return $this->_pt() . ".alta"; }
  public function altaDate() { return "CAST({$this->_pt()}.alta AS DATE)"; }
  public function altaYm() { return "DATE_FORMAT({$this->_pt()}.alta, '%Y-%m')"; }
  public function altaY() { return "DATE_FORMAT({$this->_pt()}.alta, '%Y')"; }
  public function sede() { return $this->_pt() . ".sede"; }
  public function modalidad() { return $this->_pt() . ".modalidad"; }
  public function planificacion() { return $this->_pt() . ".planificacion"; }
  public function comisionSiguiente() { return $this->_pt() . ".comision_siguiente"; }
  public function calendario() { return $this->_pt() . ".calendario"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function minTurno() { return "MIN({$this->_pt()}.turno)"; }
  public function maxTurno() { return "MAX({$this->_pt()}.turno)"; }
  public function countTurno() { return "COUNT({$this->_pt()}.turno)"; }

  public function minDivision() { return "MIN({$this->_pt()}.division)"; }
  public function maxDivision() { return "MAX({$this->_pt()}.division)"; }
  public function countDivision() { return "COUNT({$this->_pt()}.division)"; }

  public function minComentario() { return "MIN({$this->_pt()}.comentario)"; }
  public function maxComentario() { return "MAX({$this->_pt()}.comentario)"; }
  public function countComentario() { return "COUNT({$this->_pt()}.comentario)"; }

  public function minAutorizada() { return "MIN({$this->_pt()}.autorizada)"; }
  public function maxAutorizada() { return "MAX({$this->_pt()}.autorizada)"; }
  public function countAutorizada() { return "COUNT({$this->_pt()}.autorizada)"; }

  public function minApertura() { return "MIN({$this->_pt()}.apertura)"; }
  public function maxApertura() { return "MAX({$this->_pt()}.apertura)"; }
  public function countApertura() { return "COUNT({$this->_pt()}.apertura)"; }

  public function minPublicada() { return "MIN({$this->_pt()}.publicada)"; }
  public function maxPublicada() { return "MAX({$this->_pt()}.publicada)"; }
  public function countPublicada() { return "COUNT({$this->_pt()}.publicada)"; }

  public function minObservaciones() { return "MIN({$this->_pt()}.observaciones)"; }
  public function maxObservaciones() { return "MAX({$this->_pt()}.observaciones)"; }
  public function countObservaciones() { return "COUNT({$this->_pt()}.observaciones)"; }

  public function avgAlta() { return "AVG({$this->_pt()}.alta)"; }
  public function minAlta() { return "MIN({$this->_pt()}.alta)"; }
  public function maxAlta() { return "MAX({$this->_pt()}.alta)"; }
  public function countAlta() { return "COUNT({$this->_pt()}.alta)"; }

  public function minSede() { return "MIN({$this->_pt()}.sede)"; }
  public function maxSede() { return "MAX({$this->_pt()}.sede)"; }
  public function countSede() { return "COUNT({$this->_pt()}.sede)"; }

  public function minModalidad() { return "MIN({$this->_pt()}.modalidad)"; }
  public function maxModalidad() { return "MAX({$this->_pt()}.modalidad)"; }
  public function countModalidad() { return "COUNT({$this->_pt()}.modalidad)"; }

  public function minPlanificacion() { return "MIN({$this->_pt()}.planificacion)"; }
  public function maxPlanificacion() { return "MAX({$this->_pt()}.planificacion)"; }
  public function countPlanificacion() { return "COUNT({$this->_pt()}.planificacion)"; }

  public function minComisionSiguiente() { return "MIN({$this->_pt()}.comision_siguiente)"; }
  public function maxComisionSiguiente() { return "MAX({$this->_pt()}.comision_siguiente)"; }
  public function countComisionSiguiente() { return "COUNT({$this->_pt()}.comision_siguiente)"; }

  public function minCalendario() { return "MIN({$this->_pt()}.calendario)"; }
  public function maxCalendario() { return "MAX({$this->_pt()}.calendario)"; }
  public function countCalendario() { return "COUNT({$this->_pt()}.calendario)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.division, 
{$this->_pf()}sed.numero, 
{$this->_pf()}sed.nombre, 
{$this->_pf()}pla.anio, 
{$this->_pf()}pla.semestre, 
{$this->_pf()}pla_plb.orientacion, 
{$this->_pf()}pla_plb.distribucion_horaria, 
{$this->_pf()}cal.inicio, 
{$this->_pf()}cal.fin, 
{$this->_pf()}cal.anio, 
{$this->_pf()}cal.semestre)"; 
  }


}
