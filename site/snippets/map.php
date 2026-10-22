<?php
/*
  Mappa di Google incorporata, senza chiave API, con l'indirizzo delle Impostazioni sito.
  - L'iframe usa l'indirizzo "maps?q=…&output=embed": funziona senza chiave ma Google non lo documenta.
  - Il link usa invece l'indirizzo ufficiale (https://developers.google.com/maps/documentation/urls).
  Attenzione: l'iframe carica cookie di Google → da citare nella Privacy (K6) e nella CSP (K7).
*/
$address = $site->street() . ', ' . $site->zip() . ' ' . $site->city();
// hl = lingua dei comandi della mappa, la stessa della pagina.
$embedUrl = 'https://www.google.com/maps?q=' . urlencode($address) . '&hl=' . $kirby->language()->code() . '&output=embed';
$linkUrl = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($address);
?>
<div class="map">
  <p class="map__address container">
    <?= $site->street()->esc() ?>,<br>
    <?= $site->zip()->esc() ?> <?= $site->city()->esc() ?>
  </p>
  <iframe class="map__frame" src="<?= esc($embedUrl, 'attr') ?>" title="<?= esc(t('map.alt'), 'attr') ?>" loading="lazy"></iframe>
  <p class="container">
    <a class="map__link" href="<?= esc($linkUrl, 'attr') ?>" target="_blank" rel="noopener noreferrer">
      <?= esc(t('map.open')) ?><span class="visually-hidden"> (<?= esc(t('a11y.newTab')) ?>)</span>
    </a>
  </p>
</div>
