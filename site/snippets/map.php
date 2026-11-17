<?php
/*
  Mappa standard di Google incorporata (home, "Dove trovi lo studio"; decisione del cliente: niente stile,
  chiave o Map ID), con l'indirizzo delle Impostazioni sito.
  L'iframe usa l'indirizzo "maps?q=…&output=embed": funziona senza chiave ma Google non lo documenta.
  La CSP del .htaccess la permette con frame-src https://www.google.com.
  Privacy: l'iframe di Google (loading="lazy": parte solo quando la mappa si avvicina allo schermo) riceve l'IP
  del visitatore e può usare cookie di Google. È descritto nella pagina Privacy: se cambia, va aggiornata anche lei.
*/
$address = $site->street() . ', ' . $site->zip() . ' ' . $site->city();
// hl = lingua dei comandi della mappa, la stessa della pagina.
$embedUrl = 'https://www.google.com/maps?q=' . urlencode($address) . '&hl=' . $kirby->language()->code() . '&output=embed';
?>
<div class="map">
  <p class="map__address container">
    <?= $site->street()->esc() ?>,<br>
    <?= $site->zip()->esc() ?> <?= $site->city()->esc() ?>
  </p>
  <iframe class="map__frame" src="<?= esc($embedUrl, 'attr') ?>" title="<?= esc(t('map.alt'), 'attr') ?>" loading="lazy"></iframe>
</div>
