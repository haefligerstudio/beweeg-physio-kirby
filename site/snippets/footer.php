<?php
/*
  Footer: logo, indirizzo, contatti e orari. Tutti i dati vengono dalle Impostazioni sito.
*/
?>
<footer class="site-footer">
  <div class="container">
    <img class="site-footer__logo" src="<?= url('assets/images/logo-white.svg') ?>" alt="<?= $site->title()->esc() ?>" width="380" height="133">

    <div class="site-footer__columns">
      <div class="site-footer__contacts">
        <address>
          <p class="site-footer__label"><?= esc(t('footer.address')) ?></p>
          <p><?= $site->street()->esc() ?></p>
          <p><?= $site->zip()->esc() ?> <?= $site->city()->esc() ?>, <?= $site->region()->esc() ?></p>
        </address>

        <div>
          <p class="site-footer__label"><?= esc(t('footer.contacts')) ?></p>
          <?php if ($site->phone()->isNotEmpty()): ?>
          <a class="site-footer__phone" href="tel:<?= esc($site->phoneLink(), 'attr') ?>"><?= $site->phone()->esc() ?></a>
          <?php endif ?>
          <?php snippet('social') ?>
        </div>
      </div>

      <?php snippet('hours') ?>
    </div>

    <?php // Qui andranno i link a Privacy e Note legali, quando le pagine esisteranno (K6). ?>
    <p class="site-footer__copyright">© <?= date('Y') ?> <?= $site->title()->esc() ?></p>
  </div>
</footer>
