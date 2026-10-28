<?php
/*
  Footer: logo, indirizzo, contatti, orari e icone social. Tutti i dati vengono dalle Impostazioni sito.
  Un solo markup per tutte le larghezze: su mobile i blocchi sono in colonna (social in fondo),
  da tablet il CSS li dispone in due colonne con una griglia.
*/
?>
<footer class="site-footer">
  <div class="container site-footer__inner">
    <img class="site-footer__logo" src="<?= url('assets/images/logo-white.svg') ?>" alt="<?= $site->title()->esc() ?>" width="380" height="133">

    <div class="site-footer__blocks">
      <address class="site-footer__address">
        <p class="site-footer__label"><?= esc(t('footer.address')) ?></p>
        <p><?= $site->street()->esc() ?></p>
        <p><?= $site->zip()->esc() ?> <?= $site->city()->esc() ?>, <?= $site->region()->esc() ?></p>
      </address>

      <div class="site-footer__contacts">
        <p class="site-footer__label"><?= esc(t('footer.contacts')) ?></p>
        <?php if ($site->phone()->isNotEmpty()): ?>
        <a class="site-footer__phone" href="tel:<?= esc($site->phoneLink(), 'attr') ?>"><?= $site->phone()->esc() ?></a>
        <?php endif ?>
      </div>

      <?php snippet('hours') ?>
      <?php snippet('social') ?>
    </div>

    <?php // Qui andranno i link a Privacy e Note legali, quando le pagine esisteranno. ?>
    <p class="site-footer__copyright">© <?= date('Y') ?> <?= $site->title()->esc() ?></p>
  </div>
</footer>
