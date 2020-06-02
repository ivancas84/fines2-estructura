INSERT INTO sede (id, numero, nombre, observaciones, alta, domicilio, centro_educativo)
SELECT id, numero, nombre, observaciones, alta, domicilio, centro_educativo FROM planfi10_20202.sede;