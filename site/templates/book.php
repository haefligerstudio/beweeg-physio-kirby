<?php
/*
  Pagina "prenota". Non è disegnata nel visual: usa solo componenti già esistenti.
  Decisione del cliente: c'è solo il widget di SimplyBook (assets/js/booking.js); contatti e orari sono nel footer.
  - Indirizzo di prenotazione compilato e interruttore "mostra il widget" acceso (Impostazioni sito → Prenotazione):
    introduzione e widget. Senza JavaScript il widget non parte: al suo posto il numero di telefono.
  - Altrimenti: il testo di riserva del pannello e il numero di telefono, nessun link verso siti esterni.
  Campi: blueprint pages/book.yml (heading, intro, fallback); bookingUrl, bookingWidget e phone in Impostazioni sito.
  Il widget vuole due concessioni nella CSP del .htaccess: vedi il punto PRENOTAZIONE.
*/
$showWidget = $site->bookingUrl()->isNotEmpty() && $site->bookingWidget()->toBool();
?>
<?php snippet('layout', slots: true) ?>

  <?php snippet('page-intro') ?>

  <section class="section book">
    <div class="container">
      <?php snippet('section-heading', ['text' => $page->heading(), 'level' => 'h1']) ?>

      <?php if ($showWidget): ?>
      <?php if ($page->intro()->isNotEmpty()): ?>
      <?php // intro e fallback sono campi writer su una riga: HTML già ripulito da Kirby, si stampano senza esc(). ?>
      <div class="lead-text">
        <p><?= $page->intro() ?></p>
      </div>
      <?php endif ?>

      <?php // Widget a tutta la larghezza del contenitore (il calendario ha bisogno di spazio); nome accessibile: il titolo della pagina. ?>
      <div class="booking" role="region" aria-label="<?= $page->heading()->esc('attr') ?>" data-booking-url="<?= $site->bookingUrl()->esc('attr') ?>"></div>
      <?= js('https://widget.simplybook.me/v2/widget/widget.js', ['defer' => true]) ?>
      <?= js('assets/js/booking.js', ['defer' => true]) ?>

      <?php if ($site->phone()->isNotEmpty()): ?>
      <noscript>
        <div class="section__action section__action--start">
          <?php snippet('button', ['url' => 'tel:' . $site->phoneLink(), 'text' => $site->phone()->value()]) ?>
        </div>
      </noscript>
      <?php endif ?>

      <?php else: ?>
      <div class="lead-text">
        <?php if ($page->fallback()->isNotEmpty()): ?>
        <p><?= $page->fallback() ?></p>
        <?php endif ?>
        <?php if ($site->phone()->isNotEmpty()): ?>
        <div class="section__action section__action--start">
          <?php snippet('button', ['url' => 'tel:' . $site->phoneLink(), 'text' => $site->phone()->value()]) ?>
        </div>
        <?php endif ?>
      </div>
      <?php endif ?>
    </div>
  </section>

<?php endsnippet() ?>
