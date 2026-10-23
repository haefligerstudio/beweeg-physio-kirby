<?php
/*
  Pagina di un trattamento: titolo (H1), paragrafo guida, testo e pulsante per prenotare.
  Sotto, sulla banda azzurra, le schede degli altri trattamenti.
  La foto del trattamento si vede solo nelle schede, come nel visual.
*/
$others = $page->siblings(false)->listed();
?>
<?php snippet('layout', slots: true) ?>

  <?php snippet('page-intro') ?>

  <section class="section treatment-page">
    <div class="container">
      <?php snippet('section-heading', ['text' => $page->title(), 'level' => 'h1', 'size' => 'h4']) ?>
      <?php snippet('lead-text', ['lead' => $page->lead(), 'text' => $page->text()]) ?>
      <div class="section__action treatment-page__action">
        <?php snippet('button', ['url' => page('prenota')->url(), 'text' => t('buttons.book')]) ?>
      </div>
    </div>
  </section>

  <?php if ($others->isNotEmpty()): ?>
  <section class="other-treatments">
    <div class="other-treatments__grid container">
      <?php // Il titolo è uno solo per tutti i trattamenti: sta nella pagina "trattamenti". ?>
      <?php snippet('section-heading', ['text' => $page->parent()->moreTitle(), 'size' => 'h3']) ?>
      <ul class="other-treatments__list">
        <?php foreach ($others as $treatment): ?>
        <li><?php snippet('treatment-card', ['treatment' => $treatment]) ?></li>
        <?php endforeach ?>
      </ul>
    </div>
  </section>
  <?php endif ?>

<?php endsnippet() ?>
