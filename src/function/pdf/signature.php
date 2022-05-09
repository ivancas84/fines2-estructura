<?
function htmlToPdfSignature($firmar = true) {

  $selloSrc = ($firmar) ? '<img src="..' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'sello_cens.png"  width="125" height="160">' : '';
  $firmaSrc = ($firmar) ? '<img src="..' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'firma_director.png" width="250" height="150">' : '';
  return '
  <br>
  <br>
  <br>
  <table style="width:100%">
  
  <tr>
    <td style="width:30%; text-align:center">  
    </td>
    <td style="width:30%; text-align:center">' . $selloSrc . '</td>
    <td style="width:40%; text-align:center">' . $firmaSrc . '</td>
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