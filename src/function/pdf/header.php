<?
function htmlToPdfHeader($qrCode) {
  return '
  <img id="left" src="logo.jpg" >
	<img id="right" src=' .  $qrCode . '  width="3cm" height="3cm">
	<div style="clear:both;"></div>';
}
?>