<?php
/*
  Pagina "trattamenti": le schede dei trattamenti, nell'ordine del pannello, sulla banda azzurra.
  L'H1 è il titolo del contenuto ("Trattamenti disponibili"), non "Beweeg physio".
*/
?>
<?php snippet('layout', slots: true) ?>

  <?php snippet('page-intro') ?>

  <section class="section treatments-page">
    <div class="container">
      <?php snippet('section-heading', ['text' => $page->heading(), 'level' => 'h1']) ?>
    </div>

    <div class="cards-band">
      <div class="container">
        <ul class="cards">
          <?php foreach ($page->children()->listed() as $treatment): ?>
          <li><?php snippet('treatment-card', ['treatment' => $treatment]) ?></li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>

    <div class="container section__action">
      <?php snippet('button', ['url' => page('prenota')->url(), 'text' => t('buttons.book')]) ?>
    </div>
  </section>

<?php endsnippet() ?>
