SELECT CONCAT(
    "INSERT INTO planfi10_20202.email (id, email, persona) VALUES ('", 
    id, "', ", 
	IF(email IS NOT NULL, CONCAT("'", email, "'"), 'null'), ", ", 
	IF(id IS NOT NULL, CONCAT("'", id, "'"), 'null'), 
    "); "
) FROM persona
WHERE email IS NOT NULL;
