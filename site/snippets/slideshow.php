<?php
/*
  Foto che scorrono nell'apertura di ogni pagina (campo "Foto dello slideshow").
  Senza JavaScript si vede solo la prima foto e i comandi restano nascosti.
  Con JavaScript (slideshow.js) le foto cambiano da sole e si fermano con il mouse sopra
  e con il focus (anche sui pallini); con "riduci movimento" non partono e si cambiano solo con i pallini.
  Nessun pulsante pausa: l'ha chiesto Sara (eccezione a WCAG 2.2.2, vedi CAMBIAMENTI-RISPETTO-AL-VISUAL.md).
*/
$images = $site->slideshow()->toFiles();

if ($images->isEmpty()) {
    return;
}

$number = 0;
?>
<div class="slideshow" data-slideshow>
  <?php foreach ($images as $image): ?>
  <?php $number++ ?>
  <div class="slideshow__slide<?= $number === 1 ? ' is-active' : '' ?>"<?= $number === 1 ? '' : ' aria-hidden="true"' ?>>
    <?php snippet('picture', [
        'image' => $image,
        'srcset' => 'hero',
        // su mobile la foto ha i margini laterali, da tablet è a tutta larghezza
        'sizes' => '(min-width: 48rem) 100vw, calc(100vw - 3.125rem)',
        'width' => 1280,
        'lazy' => $number > 1,
    ]) ?>
  </div>
  <?php endforeach ?>

  <?php if ($images->count() > 1): ?>
  <div class="slideshow__controls" hidden>
    <?php for ($i = 1; $i <= $images->count(); $i++): ?>
    <button class="slideshow__dot" type="button" aria-label="<?= esc(t('a11y.slideGo') . ' ' . $i, 'attr') ?>"<?= $i === 1 ? ' aria-current="true"' : '' ?>></button>
    <?php endfor ?>
  </div>
  <?= js('assets/js/slideshow.js', ['defer' => true]) ?>
  <?php endif ?>
</div>
