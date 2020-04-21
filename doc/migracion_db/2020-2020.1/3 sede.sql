INSERT INTO sede (id, numero, nombre, observaciones, alta, domicilio, centro_educativo)
SELECT id, numero, nombre, observaciones, alta, domicilio, centro_educativo FROM planfi10_2020.sede;