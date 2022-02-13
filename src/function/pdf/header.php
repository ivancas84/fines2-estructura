<?
function htmlToPdfHeader($qrCode) {
  $imgSrc = ".." . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "logo.jpg";
  // $imgSrc = $_SERVER["DOCUMENT_ROOT"] .  DIRECTORY_SEPARATOR . PATH_ROOT . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'logo.jpg';
  // echo $imgSrc;
  // die();
  return '
  <img id="left" src="' . $imgSrc . '" >
	<img id="right" src="' .  $qrCode . '"  width="3cm" height="3cm">
	<div style="clear:both;"></div>';
}
?>