INSERT INTO domicilio (id, calle, entre, numero, piso, departamento, barrio, localidad)
SELECT id, calle, entre, numero, piso, departamento, barrio, localidad FROM planfi10_2020.domicilio;