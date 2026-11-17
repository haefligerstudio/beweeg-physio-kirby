<?php
/*
  Scheletro comune a tutte le pagine: head, header, main e footer.
  I template lo aprono con snippet('layout', slots: true) e il loro contenuto
  finisce in $slot, dentro <main>.
  https://getkirby.com/docs/guide/templates/snippets#slots
*/

// Titolo della scheda: quello per Google se compilato nel pannello, altrimenti "pagina · sito".
// La 404 usa il suo titolo tradotto ("Pagina non trovata"), non il titolo tecnico della pagina "error".
$pageTitle = $page->isErrorPage() ? t('error.title') : $page->title()->value();
$title = $page->seoTitle()->or($pageTitle . ' · ' . $site->title());

// HSTS con la durata dell'ambiente (opzione fisionassa.hsts in site/config): solo sulle pagine in HTTPS.
if ($kirby->environment()->https()) {
    $kirby->response()->header('Strict-Transport-Security', option('fisionassa.hsts'));
}
?>
<!DOCTYPE html>
<html lang="<?= $kirby->language()->code() ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title->esc() ?></title>
  <?php snippet('seo', ['title' => $title]) ?>

  <link rel="icon" href="<?= url('favicon.ico') ?>" sizes="48x48">
  <link rel="icon" href="<?= url('assets/images/favicon.svg') ?>" type="image/svg+xml">

  <?php // Il font del testo serve subito: lo scarichiamo prima del CSS per evitare il cambio di carattere. ?>
  <link rel="preload" href="<?= url('assets/fonts/roboto-latin-wght-normal.woff2') ?>" as="font" type="font/woff2" crossorigin>
  <?= css('assets/css/main.css') ?>

  <?php // Senza defer: la prima riga aggiunge la classe "js" prima che la pagina venga disegnata (niente lampeggio del menu). ?>
  <?= js('assets/js/main.js') ?>
</head>
<body>
  <a class="skip-link" href="#main"><?= esc(t('a11y.skip')) ?></a>

  <?php snippet('header') ?>

  <main id="main">
    <?= $slot ?>
  </main>

  <?php snippet('footer') ?>
</body>
</html>
