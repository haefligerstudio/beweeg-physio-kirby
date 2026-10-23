<?php
/*
  Titolo di sezione con il trattino sotto (visual: centrato su mobile, a sinistra da tablet).
  Parametri: $text, $level ('h1' o 'h2', di solito 'h2'),
  $italicAfterColon (true: la parte dopo i due punti va in corsivo light, es. "Un plus: servizi a domicilio"),
  $size ('h3' o 'h4': misura più piccola, per le pagine trattamento; di base quella di un H2).
  Sulla banda azzurra il colore cambia da solo (CSS), per il contrasto.
*/
$text = (string)$text;
$level = $level ?? 'h2';
$class = 'section-heading' . (isset($size) ? ' section-heading--' . $size : '');

if (($italicAfterColon ?? false) && str_contains($text, ':')) {
    [$before, $after] = explode(':', $text, 2);
    $html = esc($before) . ': <em>' . esc(trim($after)) . '</em>';
} else {
    $html = esc($text);
}
?>
<<?= $level ?> class="<?= $class ?>"><?= $html ?></<?= $level ?>>
