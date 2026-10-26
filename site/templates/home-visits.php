<?php
/*
  Pagina "servizio a domicilio": titolo (H1), sottotitolo della sezione, paragrafo guida, testo
  e pulsante per prenotare. Nessuna banda azzurra (visual).
*/
?>
<?php snippet('layout', slots: true) ?>

  <?php snippet('page-intro') ?>

  <section class="section home-visits-page">
    <div class="container">
      <?php snippet('section-heading', ['text' => $page->heading(), 'level' => 'h1']) ?>
      <?php if ($page->subheading()->isNotEmpty()): ?>
      <p class="subheading"><?= $page->subheading()->esc() ?></p>
      <?php endif ?>
      <?php snippet('lead-text', ['lead' => $page->lead(), 'text' => $page->text()]) ?>
      <div class="section__action section__action--start">
        <?php snippet('button', ['url' => page('prenota')->url(), 'text' => t('buttons.book')]) ?>
      </div>
    </div>
  </section>

<?php endsnippet() ?>
