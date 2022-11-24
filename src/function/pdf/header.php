<?
function htmlToPdfHeader($qrCode) {
  $imgSrc = ".." . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "logo.jpg";
  // $imgSrc = $_SERVER["DOCUMENT_ROOT"] .  DIRECTORY_SEPARATOR . PATH_ROOT . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'logo.jpg';
  // echo $imgSrc;
  // die();
  return '
  <img class="alignleft" src="' . $imgSrc . '" >
	<img class="alignright" src="' .  $qrCode . '"  width="3cm" height="3cm">
	<div style="clear:both;"></div>';
}
?>