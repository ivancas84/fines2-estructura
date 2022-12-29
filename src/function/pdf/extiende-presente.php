<?
function htmlToPdfExtiendePresente() {
  $date = new SpanishDateTime();
    return '<p>Se extiende la presente a pedido del interesado en La Plata el día 
    <span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("d") . ' de ' . $date->format("F") . ' de ' . $date->format("Y"). '&nbsp;&nbsp;&nbsp;</span> para ser presentado ante <span class="data">&nbsp;&nbsp;&nbsp;quien corresponda&nbsp;&nbsp;&nbsp;</span>.</p>
    </div>
    ';
}
?>