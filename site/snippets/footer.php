<?php
/*
  Footer (incluso da layout.php): logo, indirizzo, contatti, orari e icone social.
  Tutti i dati vengono dalle Impostazioni sito.
  Un solo markup per tutte le larghezze: su mobile i blocchi sono in colonna (social in fondo),
  da tablet il CSS li dispone in due colonne con una griglia.
*/
?>
<footer class="site-footer">
  <div class="container site-footer__inner">
    <img class="site-footer__logo" src="<?= url('assets/images/logo-white.svg') ?>" alt="<?= $site->title()->esc() ?>" width="380" height="139">

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

    <div class="site-footer__bottom">
      <p class="site-footer__copyright">© <?= date('Y') ?> <?= $site->title()->esc() ?></p>
      <?php // Privacy e Note legali: tutte le pagine con il template "legal", con il loro titolo (niente indirizzi scritti qui).
          // https://getkirby.com/docs/reference/objects/cms/pages/template ?>
      <ul class="site-footer__legal">
        <?php foreach ($site->children()->template('legal') as $item): ?>
        <li><a href="<?= $item->url() ?>"<?php if ($item->isActive()): ?> aria-current="page"<?php endif ?>><?= $item->title()->esc() ?></a></li>
        <?php endforeach ?>
      </ul>
    </div>
  </div>
</footer>
