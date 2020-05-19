<? require_once("../config/config.php"); ?>

<!DOCTYPE html>
<html>
<body>

<h2>Importar Carga Horaria</h2>

<form action="<?=URL?>script/1_importar_carga_horaria.php" method="POST">
  Source:<br>
  <textarea name="source"></textarea>
  <br>  
  <input type="submit" value="Submit">
</form> 

</body>
</html>
