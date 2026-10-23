<?php
/*
  Pagina "chi sono": citazione di Jan, testo con due foto, diplomi e pulsante verso i trattamenti.
  Foto e diplomi mancanti diventano riquadri neutri: il layout resta quello del visual.
*/

// Il campo Testo è un solo writer: lo divido a metà dopo un </p>, una metà accanto a ogni foto.
// La prima metà prende il paragrafo in più se sono dispari (lo spiega l'aiuto del campo nel pannello).
$paragraphs = preg_split('/(?<=<\/p>)/', $page->text()->value(), -1, PREG_SPLIT_NO_EMPTY);
$half = (int)ceil(count($paragraphs) / 2);
$textParts = [
    implode('', array_slice($paragraphs, 0, $half)),
    implode('', array_slice($paragraphs, $half)),
];

// Al massimo 2 foto (come nel campo): una per metà del testo.
$photos = $page->photos()->toFiles()->limit(2)->values();

// Almeno due diplomi nel layout del visual; se ce ne sono di più, lo schema si ripete.
$diplomas = $page->diplomas()->toFiles()->values();
$diplomaSlots = max(2, count($diplomas));
?>
<?php snippet('layout', slots: true) ?>

  <?php snippet('page-intro') ?>

  <section class="section about">
    <div class="container">
      <div class="about__heading">
        <?php snippet('section-heading', ['text' => $page->heading(), 'level' => 'h1']) ?>
        <?php if ($page->quote()->isNotEmpty()): ?>
        <?php // Frase scritta a mano (Reenie Beanie). Le virgolette le aggiunge il sito, come dice il pannello. ?>
        <blockquote class="quote">
          <p>“<?= $page->quote()->esc() ?>” <span class="quote__signature"><?= $page->signature()->esc() ?></span></p>
        </blockquote>
        <?php endif ?>
      </div>

      <?php foreach ($textParts as $i => $textPart): ?>
      <?php // Visual: da tablet la prima foto sta a sinistra del testo, la seconda a destra. ?>
      <div class="about__row<?= $i === 0 ? ' about__row--photo-first' : '' ?>">
        <div class="about__text"><?= $textPart ?></div>
        <div class="about__photo">
          <?php if (isset($photos[$i])): ?>
          <?php snippet('picture', [
              'image' => $photos[$i],
              'srcset' => 'card',
              'sizes' => '(min-width: 71.25rem) 35rem, (min-width: 48rem) 50vw, 100vw',
              'width' => 800,
              'lazy' => true,
          ]) ?>
          <?php else: ?>
          <?php snippet('placeholder', ['shape' => 'portrait']) ?>
          <?php endif ?>
        </div>
      </div>
      <?php endforeach ?>
    </div>
  </section>

  <section class="diplomas">
    <div class="container">
      <?php snippet('section-heading', ['text' => $page->diplomasTitle()]) ?>
    </div>

    <div class="diplomas__band">
      <div class="container">
        <ul class="diplomas__list">
          <?php for ($i = 0; $i < $diplomaSlots; $i++): ?>
          <?php $diploma = $diplomas[$i] ?? null ?>
          <li class="diplomas__item">
            <?php if ($diploma): ?>
            <?php // Il diploma si apre intero in una nuova scheda (DESIGN.md). Nome del link: didascalia, o testo alternativo. ?>
            <a class="diplomas__link" href="<?= $diploma->url() ?>" target="_blank" rel="noopener noreferrer">
              <?php snippet('picture', [
                  'image' => $diploma,
                  'srcset' => 'card',
                  'sizes' => '(min-width: 48rem) 60vw, 100vw',
                  'width' => 800,
                  'lazy' => true,
                  'decorative' => true,
              ]) ?>
              <span class="visually-hidden"><?= $diploma->caption()->or($diploma->alt())->esc() ?> (<?= esc(t('a11y.newTab')) ?>)</span>
            </a>
            <?php if ($diploma->caption()->isNotEmpty()): ?>
            <p class="diplomas__caption" aria-hidden="true"><?= $diploma->caption()->esc() ?></p>
            <?php endif ?>
            <?php else: ?>
            <?php // Diploma non ancora arrivato: riquadro con le proporzioni del visual (il primo orizzontale, il secondo verticale). ?>
            <?php snippet('placeholder', ['shape' => $i % 2 === 0 ? 'landscape' : 'a4']) ?>
            <?php endif ?>
          </li>
          <?php endfor ?>
        </ul>
      </div>
    </div>

    <div class="container section__action about__action">
      <?php snippet('button', ['url' => page('trattamenti')->url(), 'text' => t('buttons.treatments')]) ?>
    </div>
  </section>

<?php endsnippet() ?>
