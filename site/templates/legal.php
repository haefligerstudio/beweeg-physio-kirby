<?php
/*
  Pagine "privacy" e "note legali". Non sono disegnate nel visual: usano solo componenti già esistenti,
  come la pagina Prenota (decisione di Amos). Non sono nel menu: i link sono nel footer.
  Ordine: titolo (H1), introduzione, dati dello studio (snippet studio-data, dal pannello Sito → Dati dello studio),
  poi le sezioni (titolo e testo) nell'ordine del pannello.
  Campi: blueprint pages/legal.yml (heading, lead, studioTitle, sections).
*/
?>
<?php snippet('layout', slots: true) ?>

  <?php snippet('page-intro') ?>

  <section class="section legal">
    <div class="container">
      <?php snippet('section-heading', ['text' => $page->heading(), 'level' => 'h1']) ?>

      <div class="legal__content">
        <?php if ($page->lead()->isNotEmpty()): ?>
        <?php // Campo writer su una riga: HTML già ripulito da Kirby, si stampa senza esc(). ?>
        <p class="legal__lead"><?= $page->lead() ?></p>
        <?php endif ?>

        <?php if ($page->studioTitle()->isNotEmpty()): ?>
        <h2 class="legal__heading"><?= $page->studioTitle()->esc() ?></h2>
        <?php endif ?>
        <?php snippet('studio-data') ?>

        <?php foreach ($page->sections()->toStructure() as $item): ?>
        <h2 class="legal__heading"><?= $item->heading()->esc() ?></h2>
        <?php // Testo writer con i suoi <p>, già ripulito da Kirby. ?>
        <div class="legal__text"><?= $item->text() ?></div>
        <?php endforeach ?>
      </div>
    </div>
  </section>

<?php endsnippet() ?>
