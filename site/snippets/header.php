<?php
/*
  Barra in alto: logo e menu. Resta fissa in cima mentre si scorre (visual: "Menu desktop: sticky").
*/
?>
<header class="site-header">
  <div class="container site-header__inner">
    <a class="site-header__logo" href="<?= $site->url() ?>" aria-label="<?= esc(t('a11y.home'), 'attr') ?>">
      <img src="<?= url('assets/images/logo-white.svg') ?>" alt="" width="136" height="48">
    </a>

    <!-- Nascosto finché il JavaScript non lo attiva: senza JS il menu resta visibile sotto il logo. -->
    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="menu"
            aria-label="<?= esc(t('a11y.menuOpen'), 'attr') ?>"
            data-label-open="<?= esc(t('a11y.menuOpen'), 'attr') ?>" data-label-close="<?= esc(t('a11y.menuClose'), 'attr') ?>" hidden>
      <svg class="menu-toggle__open" aria-hidden="true" width="28" height="28" viewBox="0 0 28 28" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round">
        <path d="M4 8h20M4 14h20M4 20h20"/>
      </svg>
      <svg class="menu-toggle__close" aria-hidden="true" width="28" height="28" viewBox="0 0 28 28" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round">
        <path d="M7 7l14 14M21 7L7 21"/>
      </svg>
    </button>

    <?php snippet('menu') ?>
  </div>
</header>
