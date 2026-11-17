<?php
/*
  Tag SEO del <head>, usati dal layout: description, robots, canonical, hreflang e anteprima social (og:).
  $title: il titolo della scheda, calcolato in layout.php.
  Campi della scheda SEO di ogni pagina (seoTitle, seoDescription); l'opzione fisionassa.indexable decide il noindex.
*/

// Descrizione: quella per Google se compilata, altrimenti il paragrafo guida senza HTML (circa 160 caratteri).
// Se non c'è nessuno dei due, nessun meta: meglio niente che un testo inventato.
$description = $page->seoDescription()->or($page->lead())->excerpt(160)->value();

// La pagina di errore non va mai su Google, nemmeno a sito pubblicato.
// "!== true": se l'opzione mancasse (es. un config vecchio sul server) il sito resta fuori da Google.
$noindex = option('fisionassa.indexable') !== true || $page->isErrorPage();
?>
<?php if ($description !== ''): ?>
<meta name="description" content="<?= esc($description) ?>">
<?php endif ?>
<?php if ($noindex): ?>
<meta name="robots" content="noindex, nofollow">
<?php endif ?>
<?php if ($page->isErrorPage() === false): ?>
<link rel="canonical" href="<?= $page->url() ?>">
<?php // La stessa pagina nelle altre lingue; x-default è la lingua principale. Con una sola lingua: solo italiano. ?>
<?php foreach ($kirby->languages() as $language): ?>
<link rel="alternate" hreflang="<?= $language->code() ?>" href="<?= $page->url($language->code()) ?>">
<?php endforeach ?>
<link rel="alternate" hreflang="x-default" href="<?= $page->url($kirby->defaultLanguage()->code()) ?>">
<?php // Anteprima quando il link si condivide (WhatsApp, Facebook…): https://ogp.me ?>
<?php // Immagine provvisoria (logo bianco su #2c7da4, 1200×630): si sostituisce il file, i tag restano uguali. ?>
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= $site->title()->esc() ?>">
<meta property="og:title" content="<?= $title->esc() ?>">
<?php if ($description !== ''): ?>
<meta property="og:description" content="<?= esc($description) ?>">
<?php endif ?>
<meta property="og:url" content="<?= $page->url() ?>">
<meta property="og:image" content="<?= url('assets/images/og-image.png') ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="<?= $site->title()->esc() ?>">
<?php endif ?>
<?php if ($page->isHomePage()): ?>
<?php snippet('schema') ?>
<?php endif ?>
