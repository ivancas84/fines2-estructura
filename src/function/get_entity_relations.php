<?php

function get_entity_relations($entityName) {
  switch($entityName){
    case 'alumno': return [
      'per' => 'persona',
      'per_dom' => 'domicilio',
      'com' => 'comision',
      'com_sed' => 'sede',
      'com_sed_dom' => 'domicilio',
      'com_sed_ts' => 'tipo_sede',
      'com_sed_ce' => 'centro_educativo',
      'com_sed_ce_dom' => 'domicilio',
      'com_moa' => 'modalidad',
      'com_pla' => 'planificacion',
      'com_pla_plb' => 'plan',
      'com_cal' => 'calendario',
    ];

    case 'asignacion_planilla_docente': return [
      'pd' => 'planilla_docente',
      'tom' => 'toma',
      'tom_cur' => 'curso',
      'tom_cur_com' => 'comision',
      'tom_cur_com_sed' => 'sede',
      'tom_cur_com_sed_dom' => 'domicilio',
      'tom_cur_com_sed_ts' => 'tipo_sede',
      'tom_cur_com_sed_ce' => 'centro_educativo',
      'tom_cur_com_sed_ce_dom' => 'domicilio',
      'tom_cur_com_moa' => 'modalidad',
      'tom_cur_com_pla' => 'planificacion',
      'tom_cur_com_pla_plb' => 'plan',
      'tom_cur_com_cal' => 'calendario',
      'tom_cur_asi' => 'asignatura',
      'tom_doc' => 'persona',
      'tom_doc_dom' => 'domicilio',
      'tom_ree' => 'persona',
      'tom_ree_dom' => 'domicilio',
      'tom_pd' => 'planilla_docente',
    ];

    case 'calificacion': return [
      'cur' => 'curso',
      'cur_com' => 'comision',
      'cur_com_sed' => 'sede',
      'cur_com_sed_dom' => 'domicilio',
      'cur_com_sed_ts' => 'tipo_sede',
      'cur_com_sed_ce' => 'centro_educativo',
      'cur_com_sed_ce_dom' => 'domicilio',
      'cur_com_moa' => 'modalidad',
      'cur_com_pla' => 'planificacion',
      'cur_com_pla_plb' => 'plan',
      'cur_com_cal' => 'calendario',
      'cur_asi' => 'asignatura',
      'per' => 'persona',
      'per_dom' => 'domicilio',
    ];

    case 'centro_educativo': return [
      'dom' => 'domicilio',
    ];

    case 'comision': return [
      'sed' => 'sede',
      'sed_dom' => 'domicilio',
      'sed_ts' => 'tipo_sede',
      'sed_ce' => 'centro_educativo',
      'sed_ce_dom' => 'domicilio',
      'moa' => 'modalidad',
      'pla' => 'planificacion',
      'pla_plb' => 'plan',
      'cal' => 'calendario',
    ];

    case 'comision_relacionada': return [
      'com' => 'comision',
      'com_sed' => 'sede',
      'com_sed_dom' => 'domicilio',
      'com_sed_ts' => 'tipo_sede',
      'com_sed_ce' => 'centro_educativo',
      'com_sed_ce_dom' => 'domicilio',
      'com_moa' => 'modalidad',
      'com_pla' => 'planificacion',
      'com_pla_plb' => 'plan',
      'com_cal' => 'calendario',
      'rel' => 'comision',
      'rel_sed' => 'sede',
      'rel_sed_dom' => 'domicilio',
      'rel_sed_ts' => 'tipo_sede',
      'rel_sed_ce' => 'centro_educativo',
      'rel_sed_ce_dom' => 'domicilio',
      'rel_moa' => 'modalidad',
      'rel_pla' => 'planificacion',
      'rel_pla_plb' => 'plan',
      'rel_cal' => 'calendario',
    ];

    case 'contralor': return [
      'pd' => 'planilla_docente',
    ];

    case 'curso': return [
      'com' => 'comision',
      'com_sed' => 'sede',
      'com_sed_dom' => 'domicilio',
      'com_sed_ts' => 'tipo_sede',
      'com_sed_ce' => 'centro_educativo',
      'com_sed_ce_dom' => 'domicilio',
      'com_moa' => 'modalidad',
      'com_pla' => 'planificacion',
      'com_pla_plb' => 'plan',
      'com_cal' => 'calendario',
      'asi' => 'asignatura',
    ];

    case 'designacion': return [
      'car' => 'cargo',
      'sed' => 'sede',
      'sed_dom' => 'domicilio',
      'sed_ts' => 'tipo_sede',
      'sed_ce' => 'centro_educativo',
      'sed_ce_dom' => 'domicilio',
      'per' => 'persona',
      'per_dom' => 'domicilio',
    ];

    case 'detalle_persona': return [
      'arc' => 'file',
      'per' => 'persona',
      'per_dom' => 'domicilio',
    ];

    case 'distribucion_horaria': return [
      'asi' => 'asignatura',
      'pla' => 'planificacion',
      'pla_plb' => 'plan',
    ];

    case 'email': return [
      'per' => 'persona',
      'per_dom' => 'domicilio',
    ];

    case 'horario': return [
      'cur' => 'curso',
      'cur_com' => 'comision',
      'cur_com_sed' => 'sede',
      'cur_com_sed_dom' => 'domicilio',
      'cur_com_sed_ts' => 'tipo_sede',
      'cur_com_sed_ce' => 'centro_educativo',
      'cur_com_sed_ce_dom' => 'domicilio',
      'cur_com_moa' => 'modalidad',
      'cur_com_pla' => 'planificacion',
      'cur_com_pla_plb' => 'plan',
      'cur_com_cal' => 'calendario',
      'cur_asi' => 'asignatura',
      'dia' => 'dia',
    ];

    case 'persona': return [
      'dom' => 'domicilio',
    ];

    case 'planificacion': return [
      'plb' => 'plan',
    ];

    case 'sede': return [
      'dom' => 'domicilio',
      'ts' => 'tipo_sede',
      'ce' => 'centro_educativo',
      'ce_dom' => 'domicilio',
    ];

    case 'telefono': return [
      'per' => 'persona',
      'per_dom' => 'domicilio',
    ];

    case 'toma': return [
      'cur' => 'curso',
      'cur_com' => 'comision',
      'cur_com_sed' => 'sede',
      'cur_com_sed_dom' => 'domicilio',
      'cur_com_sed_ts' => 'tipo_sede',
      'cur_com_sed_ce' => 'centro_educativo',
      'cur_com_sed_ce_dom' => 'domicilio',
      'cur_com_moa' => 'modalidad',
      'cur_com_pla' => 'planificacion',
      'cur_com_pla_plb' => 'plan',
      'cur_com_cal' => 'calendario',
      'cur_asi' => 'asignatura',
      'doc' => 'persona',
      'doc_dom' => 'domicilio',
      'ree' => 'persona',
      'ree_dom' => 'domicilio',
      'pd' => 'planilla_docente',
    ];

    default: return [];
  }
}
