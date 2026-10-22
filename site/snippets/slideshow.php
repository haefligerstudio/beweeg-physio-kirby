<?php
/*
  Foto che scorrono nell'apertura di ogni pagina (campo "Foto dello slideshow").
  Senza JavaScript si vede solo la prima foto e i comandi restano nascosti.
  Con JavaScript (slideshow.js) le foto cambiano da sole, con pausa obbligatoria:
  nessun movimento automatico che non si possa fermare (WCAG 2.2.2).
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
    <div class="slideshow__dots">
      <?php for ($i = 1; $i <= $images->count(); $i++): ?>
      <button class="slideshow__dot" type="button" aria-label="<?= esc(t('a11y.slideGo') . ' ' . $i, 'attr') ?>"<?= $i === 1 ? ' aria-current="true"' : '' ?>></button>
      <?php endfor ?>
    </div>
    <button class="slideshow__pause" type="button"
            aria-label="<?= esc(t('a11y.slidePause'), 'attr') ?>"
            data-label-pause="<?= esc(t('a11y.slidePause'), 'attr') ?>"
            data-label-play="<?= esc(t('a11y.slidePlay'), 'attr') ?>">
      <svg class="slideshow__icon-pause" aria-hidden="true" width="12" height="14" viewBox="0 0 12 14" fill="currentColor"><path d="M0 0h4v14H0zM8 0h4v14H8z"/></svg>
      <svg class="slideshow__icon-play" aria-hidden="true" width="12" height="14" viewBox="0 0 12 14" fill="currentColor"><path d="M0 0l12 7-12 7z"/></svg>
    </button>
  </div>
  <?= js('assets/js/slideshow.js', ['defer' => true]) ?>
  <?php endif ?>
</div>
