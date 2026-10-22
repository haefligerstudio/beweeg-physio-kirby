<?php
/*
  Apertura di ogni pagina: slideshow, "Beweeg physio" e il sottotitolo della pagina (campo tagline).
  Un solo H1 per pagina: "Beweeg physio" è l'H1 solo nella home ($h1 = true);
  nelle altre pagine l'H1 è il titolo del contenuto (DESIGN.md).
  Nello slot si può mettere un pulsante, che su desktop sta a destra del testo.
*/
$tag = ($h1 ?? false) ? 'h1' : 'p';

// Visual: la prima parola del titolo in grassetto, il resto light ("Beweeg physio").
$words = explode(' ', $site->title()->value(), 2);
?>
<div class="page-intro">
  <div class="page-intro__frame">
    <?php snippet('slideshow') ?>
    <div class="page-intro__content container">
      <div>
        <<?= $tag ?> class="page-intro__title">
          <strong><?= esc($words[0]) ?></strong> <?= esc($words[1] ?? '') ?>
        </<?= $tag ?>>
        <p class="page-intro__tagline"><?= $page->tagline()->esc() ?></p>
      </div>
      <?php if ($slot ?? null): ?>
      <div class="page-intro__action"><?= $slot ?></div>
      <?php endif ?>
    </div>
  </div>
</div>
