<? require_once("../../config/config.php"); 
$headers = (isset($_GET["headers"]))? $_GET["headers"] : "per_apellidos, per_nombres, per_numero_documento, nota_final, crec, observaciones"; 
?>

<!DOCTYPE html>
<html>
<head>
<style>
textarea {
  width: 1000px;
  height: 150px;
}
</style>
</head>
<body>


<h2>Controlar DNIS</h2>

<form action="./process.php" method="POST">
  <br>Pegar columna con numero de documento:<br>
  <textarea name="source"></textarea>
  <br>  
  <input type="submit" value="Submit">
</form> 

</body>
</html>
