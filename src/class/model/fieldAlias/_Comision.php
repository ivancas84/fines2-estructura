<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _ComisionFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function turno() { return $this->mapping->turno() . " AS " . $this->_pf() . "turno"; }
  public function division() { return $this->mapping->division() . " AS " . $this->_pf() . "division"; }
  public function comentario() { return $this->mapping->comentario() . " AS " . $this->_pf() . "comentario"; }
  public function autorizada() { return $this->mapping->autorizada() . " AS " . $this->_pf() . "autorizada"; }
  public function apertura() { return $this->mapping->apertura() . " AS " . $this->_pf() . "apertura"; }
  public function publicada() { return $this->mapping->publicada() . " AS " . $this->_pf() . "publicada"; }
  public function observaciones() { return $this->mapping->observaciones() . " AS " . $this->_pf() . "observaciones"; }
  public function alta() { return $this->mapping->alta() . " AS " . $this->_pf() . "alta"; }
  public function altaDate() { return $this->mapping->altaDate() . " AS " . $this->_pf() . "alta_date"; }
  public function altaYm() { return $this->mapping->altaYm() . " AS " . $this->_pf() . "alta_ym"; }
  public function altaY() { return $this->mapping->altaY() . " AS " . $this->_pf() . "alta_y"; }
  public function identificacion() { return $this->mapping->identificacion() . " AS " . $this->_pf() . "identificacion"; }
  public function sede() { return $this->mapping->sede() . " AS " . $this->_pf() . "sede"; }
  public function modalidad() { return $this->mapping->modalidad() . " AS " . $this->_pf() . "modalidad"; }
  public function planificacion() { return $this->mapping->planificacion() . " AS " . $this->_pf() . "planificacion"; }
  public function comisionSiguiente() { return $this->mapping->comisionSiguiente() . " AS " . $this->_pf() . "comision_siguiente"; }
  public function calendario() { return $this->mapping->calendario() . " AS " . $this->_pf() . "calendario"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function minTurno() { return $this->mapping->minTurno() . " AS " . $this->_pf() . "min_turno"; }
  public function maxTurno() { return $this->mapping->maxTurno() . " AS " . $this->_pf() . "max_turno"; }
  public function countTurno() { return $this->mapping->countTurno() . " AS " . $this->_pf() . "count_turno"; }

  public function minDivision() { return $this->mapping->minDivision() . " AS " . $this->_pf() . "min_division"; }
  public function maxDivision() { return $this->mapping->maxDivision() . " AS " . $this->_pf() . "max_division"; }
  public function countDivision() { return $this->mapping->countDivision() . " AS " . $this->_pf() . "count_division"; }

  public function minComentario() { return $this->mapping->minComentario() . " AS " . $this->_pf() . "min_comentario"; }
  public function maxComentario() { return $this->mapping->maxComentario() . " AS " . $this->_pf() . "max_comentario"; }
  public function countComentario() { return $this->mapping->countComentario() . " AS " . $this->_pf() . "count_comentario"; }

  public function minAutorizada() { return $this->mapping->minAutorizada() . " AS " . $this->_pf() . "min_autorizada"; }
  public function maxAutorizada() { return $this->mapping->maxAutorizada() . " AS " . $this->_pf() . "max_autorizada"; }
  public function countAutorizada() { return $this->mapping->countAutorizada() . " AS " . $this->_pf() . "count_autorizada"; }

  public function minApertura() { return $this->mapping->minApertura() . " AS " . $this->_pf() . "min_apertura"; }
  public function maxApertura() { return $this->mapping->maxApertura() . " AS " . $this->_pf() . "max_apertura"; }
  public function countApertura() { return $this->mapping->countApertura() . " AS " . $this->_pf() . "count_apertura"; }

  public function minPublicada() { return $this->mapping->minPublicada() . " AS " . $this->_pf() . "min_publicada"; }
  public function maxPublicada() { return $this->mapping->maxPublicada() . " AS " . $this->_pf() . "max_publicada"; }
  public function countPublicada() { return $this->mapping->countPublicada() . " AS " . $this->_pf() . "count_publicada"; }

  public function minObservaciones() { return $this->mapping->minObservaciones() . " AS " . $this->_pf() . "min_observaciones"; }
  public function maxObservaciones() { return $this->mapping->maxObservaciones() . " AS " . $this->_pf() . "max_observaciones"; }
  public function countObservaciones() { return $this->mapping->countObservaciones() . " AS " . $this->_pf() . "count_observaciones"; }

  public function avgAlta() { return $this->mapping->avgAlta() . " AS " . $this->_pf() . "avg_alta"; }
  public function minAlta() { return $this->mapping->minAlta() . " AS " . $this->_pf() . "min_alta"; }
  public function maxAlta() { return $this->mapping->maxAlta() . " AS " . $this->_pf() . "max_alta"; }
  public function countAlta() { return $this->mapping->countAlta() . " AS " . $this->_pf() . "count_alta"; }

  public function minIdentificacion() { return $this->mapping->minIdentificacion() . " AS " . $this->_pf() . "min_identificacion"; }
  public function maxIdentificacion() { return $this->mapping->maxIdentificacion() . " AS " . $this->_pf() . "max_identificacion"; }
  public function countIdentificacion() { return $this->mapping->countIdentificacion() . " AS " . $this->_pf() . "count_identificacion"; }

  public function minSede() { return $this->mapping->minSede() . " AS " . $this->_pf() . "min_sede"; }
  public function maxSede() { return $this->mapping->maxSede() . " AS " . $this->_pf() . "max_sede"; }
  public function countSede() { return $this->mapping->countSede() . " AS " . $this->_pf() . "count_sede"; }

  public function minModalidad() { return $this->mapping->minModalidad() . " AS " . $this->_pf() . "min_modalidad"; }
  public function maxModalidad() { return $this->mapping->maxModalidad() . " AS " . $this->_pf() . "max_modalidad"; }
  public function countModalidad() { return $this->mapping->countModalidad() . " AS " . $this->_pf() . "count_modalidad"; }

  public function minPlanificacion() { return $this->mapping->minPlanificacion() . " AS " . $this->_pf() . "min_planificacion"; }
  public function maxPlanificacion() { return $this->mapping->maxPlanificacion() . " AS " . $this->_pf() . "max_planificacion"; }
  public function countPlanificacion() { return $this->mapping->countPlanificacion() . " AS " . $this->_pf() . "count_planificacion"; }

  public function minComisionSiguiente() { return $this->mapping->minComisionSiguiente() . " AS " . $this->_pf() . "min_comision_siguiente"; }
  public function maxComisionSiguiente() { return $this->mapping->maxComisionSiguiente() . " AS " . $this->_pf() . "max_comision_siguiente"; }
  public function countComisionSiguiente() { return $this->mapping->countComisionSiguiente() . " AS " . $this->_pf() . "count_comision_siguiente"; }

  public function minCalendario() { return $this->mapping->minCalendario() . " AS " . $this->_pf() . "min_calendario"; }
  public function maxCalendario() { return $this->mapping->maxCalendario() . " AS " . $this->_pf() . "max_calendario"; }
  public function countCalendario() { return $this->mapping->countCalendario() . " AS " . $this->_pf() . "count_calendario"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
