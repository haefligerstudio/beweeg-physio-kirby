<?php
/*
  Pulsante a pillola con freccia, l'unico del sito.
  Parametri: $url (indirizzo), $text (scritta).
  La freccia si sposta un poco all'hover e al focus (solo CSS, ferma con prefers-reduced-motion).
*/
?>
<a class="button" href="<?= esc($url, 'attr') ?>">
  <?= esc($text) ?>
  <svg class="button__arrow" aria-hidden="true" width="8" height="14" viewBox="0 0 8 14" fill="none" stroke="currentColor" stroke-width="1.8">
    <path d="M1 1l6 6-6 6"/>
  </svg>
</a>
