<?php
/*
  Pagina non trovata (404). I testi sono nel file della lingua (error.*, buttons.home),
  così si traducono come il resto dell'interfaccia.
*/
?>
<?php snippet('layout', slots: true) ?>
  <section class="section error-page">
    <div class="container">
      <?php snippet('section-heading', ['text' => t('error.title'), 'level' => 'h1']) ?>
      <p class="error-page__text"><?= esc(t('error.text')) ?></p>
      <div class="section__action">
        <?php snippet('button', ['url' => $site->url(), 'text' => t('buttons.home')]) ?>
      </div>
    </div>
  </section>
<?php endsnippet() ?>
