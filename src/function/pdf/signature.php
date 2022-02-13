<?
function htmlToPdfSignature() {
  $selloSrc = ".." . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "sello_cens.png";
  $firmaSrc = ".." . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "firma_director.png";
  return '
  <br>
  <br>
  <br>
  <table style="width:100%">
  
  <tr>
    <td style="width:30%; text-align:center">  
    </td>
    <td style="width:30%; text-align:center">  <img src="' . $selloSrc . '"  width="125" height="160">
    </td>
    <td style="width:40%; text-align:center">  <img src="' . $firmaSrc . '"  width="250" height="150">
    </td>
  </tr>
  <tr>
  <td style="width:30%; text-align:center">  
  </td>
  <td style="width:30%; text-align:center"> 
  </td>
  <td style="width:40%; text-align:center"> Firma Autoridad
  </td>
</tr>
  </table> 
  <br>
  <br>
';
}
?>