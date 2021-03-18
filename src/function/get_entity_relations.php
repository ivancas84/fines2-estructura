<?php

function get_entity_relations($entityName) {
  switch($entityName){
    case 'alumno': return [
      '' => 'persona',
      'per' => 'domicilio',
      '' => 'comision',
      'com' => 'sede',
      'com_sed' => 'domicilio',
      'com_sed' => 'tipo_sede',
      'com_sed' => 'centro_educativo',
      'com_sed_ce' => 'domicilio',
      'com' => 'modalidad',
      'com' => 'planificacion',
      'com_pla' => 'plan',
      'com' => 'calendario',
    ];

    case 'asignacion_planilla_docente': return [
      '' => 'planilla_docente',
      '' => 'toma',
      'tom' => 'curso',
      'tom_cur' => 'comision',
      'tom_cur_com' => 'sede',
      'tom_cur_com_sed' => 'domicilio',
      'tom_cur_com_sed' => 'tipo_sede',
      'tom_cur_com_sed' => 'centro_educativo',
      'tom_cur_com_sed_ce' => 'domicilio',
      'tom_cur_com' => 'modalidad',
      'tom_cur_com' => 'planificacion',
      'tom_cur_com_pla' => 'plan',
      'tom_cur_com' => 'calendario',
      'tom_cur' => 'asignatura',
      'tom' => 'persona',
      'tom_doc' => 'domicilio',
      'tom' => 'persona',
      'tom_ree' => 'domicilio',
      'tom' => 'planilla_docente',
    ];

    case 'calificacion': return [
      '' => 'curso',
      'cur' => 'comision',
      'cur_com' => 'sede',
      'cur_com_sed' => 'domicilio',
      'cur_com_sed' => 'tipo_sede',
      'cur_com_sed' => 'centro_educativo',
      'cur_com_sed_ce' => 'domicilio',
      'cur_com' => 'modalidad',
      'cur_com' => 'planificacion',
      'cur_com_pla' => 'plan',
      'cur_com' => 'calendario',
      'cur' => 'asignatura',
      '' => 'persona',
      'per' => 'domicilio',
    ];

    case 'centro_educativo': return [
      '' => 'domicilio',
    ];

    case 'comision': return [
      '' => 'sede',
      'sed' => 'domicilio',
      'sed' => 'tipo_sede',
      'sed' => 'centro_educativo',
      'sed_ce' => 'domicilio',
      '' => 'modalidad',
      '' => 'planificacion',
      'pla' => 'plan',
      '' => 'calendario',
    ];

    case 'comision_relacionada': return [
      '' => 'comision',
      'com' => 'sede',
      'com_sed' => 'domicilio',
      'com_sed' => 'tipo_sede',
      'com_sed' => 'centro_educativo',
      'com_sed_ce' => 'domicilio',
      'com' => 'modalidad',
      'com' => 'planificacion',
      'com_pla' => 'plan',
      'com' => 'calendario',
      '' => 'comision',
      'rel' => 'sede',
      'rel_sed' => 'domicilio',
      'rel_sed' => 'tipo_sede',
      'rel_sed' => 'centro_educativo',
      'rel_sed_ce' => 'domicilio',
      'rel' => 'modalidad',
      'rel' => 'planificacion',
      'rel_pla' => 'plan',
      'rel' => 'calendario',
    ];

    case 'contralor': return [
      '' => 'planilla_docente',
    ];

    case 'curso': return [
      '' => 'comision',
      'com' => 'sede',
      'com_sed' => 'domicilio',
      'com_sed' => 'tipo_sede',
      'com_sed' => 'centro_educativo',
      'com_sed_ce' => 'domicilio',
      'com' => 'modalidad',
      'com' => 'planificacion',
      'com_pla' => 'plan',
      'com' => 'calendario',
      '' => 'asignatura',
    ];

    case 'designacion': return [
      '' => 'cargo',
      '' => 'sede',
      'sed' => 'domicilio',
      'sed' => 'tipo_sede',
      'sed' => 'centro_educativo',
      'sed_ce' => 'domicilio',
      '' => 'persona',
      'per' => 'domicilio',
    ];

    case 'detalle_persona': return [
      '' => 'file',
      '' => 'persona',
      'per' => 'domicilio',
    ];

    case 'distribucion_horaria': return [
      '' => 'asignatura',
      '' => 'planificacion',
      'pla' => 'plan',
    ];

    case 'email': return [
      '' => 'persona',
      'per' => 'domicilio',
    ];

    case 'horario': return [
      '' => 'curso',
      'cur' => 'comision',
      'cur_com' => 'sede',
      'cur_com_sed' => 'domicilio',
      'cur_com_sed' => 'tipo_sede',
      'cur_com_sed' => 'centro_educativo',
      'cur_com_sed_ce' => 'domicilio',
      'cur_com' => 'modalidad',
      'cur_com' => 'planificacion',
      'cur_com_pla' => 'plan',
      'cur_com' => 'calendario',
      'cur' => 'asignatura',
      '' => 'dia',
    ];

    case 'persona': return [
      '' => 'domicilio',
    ];

    case 'planificacion': return [
      '' => 'plan',
    ];

    case 'sede': return [
      '' => 'domicilio',
      '' => 'tipo_sede',
      '' => 'centro_educativo',
      'ce' => 'domicilio',
    ];

    case 'telefono': return [
      '' => 'persona',
      'per' => 'domicilio',
    ];

    case 'toma': return [
      '' => 'curso',
      'cur' => 'comision',
      'cur_com' => 'sede',
      'cur_com_sed' => 'domicilio',
      'cur_com_sed' => 'tipo_sede',
      'cur_com_sed' => 'centro_educativo',
      'cur_com_sed_ce' => 'domicilio',
      'cur_com' => 'modalidad',
      'cur_com' => 'planificacion',
      'cur_com_pla' => 'plan',
      'cur_com' => 'calendario',
      'cur' => 'asignatura',
      '' => 'persona',
      'doc' => 'domicilio',
      '' => 'persona',
      'ree' => 'domicilio',
      '' => 'planilla_docente',
    ];

    default: return [];
  }
}
