<?php
/*
  Tag SEO del <head>, usati dal layout: description, robots, canonical e hreflang.
  Campi della scheda SEO di ogni pagina (seoTitle, seoDescription); l'opzione beweeg.indexable decide il noindex.
*/

// Descrizione: quella per Google se compilata, altrimenti il paragrafo guida senza HTML (circa 160 caratteri).
// Se non c'è nessuno dei due, nessun meta: meglio niente che un testo inventato.
$description = $page->seoDescription()->or($page->lead())->excerpt(160)->value();

// La pagina di errore non va mai su Google, nemmeno a sito pubblicato.
$noindex = option('beweeg.indexable') === false || $page->isErrorPage();
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
<?php endif ?>
<?php if ($page->isHomePage()): ?>
<?php snippet('schema') ?>
<?php endif ?>
