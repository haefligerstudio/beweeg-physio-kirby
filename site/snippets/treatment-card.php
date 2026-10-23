<?php
/*
  Scheda di un trattamento: foto, nome breve e "scopri ora". Tutta la scheda è un solo link.
  Parametro: $treatment (pagina trattamento).
  La foto è decorativa (alt vuoto): il nome del trattamento nel link dice già tutto.
  Senza foto resta il fondo blu della scheda: il nome bianco si legge comunque.
*/
$photo = $treatment->photo()->toFile();
?>
<a class="treatment-card" href="<?= $treatment->url() ?>">
  <span class="treatment-card__photo">
    <?php if ($photo): ?>
    <?php snippet('picture', [
        'image' => $photo,
        'srcset' => 'card',
        // una colonna su mobile, due da tablet, al massimo metà del contenitore
        'sizes' => '(min-width: 71.25rem) 35rem, (min-width: 48rem) 50vw, 100vw',
        'width' => 800,
        'lazy' => true,
        'decorative' => true,
    ]) ?>
    <?php endif ?>
  </span>
  <span class="treatment-card__content">
    <span class="treatment-card__label"><?= $treatment->label()->esc() ?></span>
    <?php snippet('button', ['text' => t('buttons.discover')]) ?>
  </span>
</a>
