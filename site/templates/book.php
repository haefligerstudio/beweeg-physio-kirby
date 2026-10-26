<?php
/*
  Pagina "prenota". Non è disegnata nel visual: usa solo componenti già esistenti.
  - Link di prenotazione compilato (Impostazioni sito): pulsante verso lo strumento, in una nuova scheda.
    L'incorporamento nella pagina arriverà in K6, quando lo strumento sarà scelto.
  - Link vuoto: il testo di riserva del pannello.
  In tutti e due i casi, sotto: contatti diretti e orari.
*/
$contacts = [];
if ($site->phone()->isNotEmpty()) {
    $contacts[] = ['url' => 'tel:' . $site->phoneLink(), 'text' => $site->phone()->value()];
}
if ($site->whatsapp()->isNotEmpty()) {
    $contacts[] = ['url' => $site->whatsapp()->value(), 'text' => t('social.whatsapp')];
}
if ($site->email()->isNotEmpty()) {
    $contacts[] = ['url' => 'mailto:' . $site->email()->value(), 'text' => $site->email()->value()];
}
?>
<?php snippet('layout', slots: true) ?>

  <?php snippet('page-intro') ?>

  <section class="section book">
    <div class="container">
      <?php snippet('section-heading', ['text' => $page->heading(), 'level' => 'h1']) ?>

      <div class="lead-text">
        <?php if ($page->intro()->isNotEmpty()): ?>
        <p><?= $page->intro() ?></p>
        <?php endif ?>

        <?php if ($site->bookingUrl()->isNotEmpty()): ?>
        <div class="section__action section__action--start">
          <?php snippet('button', ['url' => $site->bookingUrl()->value(), 'text' => t('buttons.book'), 'newTab' => true]) ?>
        </div>
        <?php elseif ($page->fallback()->isNotEmpty()): ?>
        <p class="book__fallback"><?= $page->fallback() ?></p>
        <?php endif ?>
      </div>

      <?php if ($contacts !== [] || $site->hours()->toStructure()->isNotEmpty()): ?>
      <div class="book__contacts">
        <h2 class="book__label"><?= esc(t('footer.contacts')) ?></h2>
        <?php if ($contacts !== []): ?>
        <ul class="book__buttons">
          <?php foreach ($contacts as $contact): ?>
          <li><?php snippet('button', $contact) ?></li>
          <?php endforeach ?>
        </ul>
        <?php endif ?>
        <?php snippet('hours') ?>
      </div>
      <?php endif ?>
    </div>
  </section>

<?php endsnippet() ?>
