<?php
/*
  Pulsante a pillola con freccia, l'unico del sito.
  Parametri: $url (indirizzo), $text (scritta).
  Senza $url diventa solo l'aspetto del pulsante (<span>): serve dentro un elemento che è già
  un link, come le schede dei trattamenti (un link dentro un link non è valido).
  La freccia si sposta un poco all'hover e al focus (solo CSS, ferma con prefers-reduced-motion).
*/
$tag = isset($url) ? 'a' : 'span';
?>
<<?= $tag ?> class="button"<?php if (isset($url)): ?> href="<?= esc($url, 'attr') ?>"<?php endif ?>>
  <?= esc($text) ?>
  <svg class="button__arrow" aria-hidden="true" width="8" height="14" viewBox="0 0 8 14" fill="none" stroke="currentColor" stroke-width="1.8">
    <path d="M1 1l6 6-6 6"/>
  </svg>
</<?= $tag ?>>
