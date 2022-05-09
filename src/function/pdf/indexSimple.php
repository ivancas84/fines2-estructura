<?
function htmlToPdfIndexSimple($container) {
  return '
<!DOCTYPE html>
<html>
<style>
<body>
<div>
  ' . $container . '
</div>
</body>
</html>';
}
?>