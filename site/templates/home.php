<?php
/*
  Home. Sezioni nell'ordine del visual: apertura, chi sono (con i numeri), cosa faccio,
  un plus (servizio a domicilio), dove trovi lo studio.
*/
$about = page('chi-sono');
$treatments = page('trattamenti');
?>
<?php snippet('layout', slots: true) ?>

  <?php snippet('page-intro', ['h1' => true], slots: true) ?>
    <?php snippet('button', ['url' => $about->url(), 'text' => t('buttons.learnMore')]) ?>
  <?php endsnippet() ?>

  <section class="section home-about">
    <div class="container">
      <?php snippet('section-heading', ['text' => $page->aboutTitle()]) ?>
      <?php snippet('lead-text', ['lead' => $page->aboutLead(), 'text' => $page->aboutText()]) ?>

      <div class="home-about__footer">
        <div class="home-about__button">
          <?php snippet('button', ['url' => $about->url(), 'text' => t('buttons.learnMore')]) ?>
        </div>
        <ul class="stats">
          <?php foreach ($page->stats()->toStructure() as $stat): ?>
          <li class="stats__item">
            <span class="stats__value"><?= $stat->value()->esc() ?></span>
            <span class="stats__label"><?= $stat->label()->esc() ?></span>
          </li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>
  </section>

  <section class="section home-treatments">
    <div class="container">
      <?php snippet('section-heading', ['text' => $page->whatTitle()]) ?>
      <ul class="home-treatments__list">
        <?php foreach ($treatments->children()->listed() as $treatment): ?>
        <li><?php snippet('treatment-link', ['treatment' => $treatment]) ?></li>
        <?php endforeach ?>
      </ul>
      <div class="section__action">
        <?php snippet('button', ['url' => $treatments->url(), 'text' => t('buttons.discover')]) ?>
      </div>
    </div>
  </section>

  <section class="section home-visits">
    <div class="container">
      <?php snippet('section-heading', ['text' => $page->visitsTitle(), 'italicAfterColon' => true]) ?>
      <?php snippet('lead-text', ['lead' => $page->visitsLead(), 'text' => $page->visitsText()]) ?>
      <div class="section__action home-visits__action">
        <?php snippet('button', ['url' => page('servizio-a-domicilio')->url(), 'text' => t('buttons.discover')]) ?>
      </div>
    </div>
  </section>

  <?php snippet('band', slots: true) ?>
    <div class="container">
      <?php snippet('section-heading', ['text' => $page->whereTitle()]) ?>
    </div>
    <?php snippet('map') ?>
    <div class="container section__action">
      <?php snippet('button', ['url' => page('prenota')->url(), 'text' => t('buttons.book')]) ?>
    </div>
  <?php endsnippet() ?>

<?php endsnippet() ?>
