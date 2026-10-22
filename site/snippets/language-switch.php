<?php
/*
  Selettore lingua. Con una sola lingua attiva non mostra niente.
  Ogni link porta alla stessa pagina nell'altra lingua (gli indirizzi sono tradotti).
  https://getkirby.com/docs/guide/languages/switching-languages
*/
if ($kirby->languages()->count() < 2) {
    return;
}
?>
<ul class="language-switch" aria-label="<?= esc(t('a11y.language'), 'attr') ?>">
  <?php foreach ($kirby->languages() as $language): ?>
  <li>
    <a href="<?= $page->url($language->code()) ?>" hreflang="<?= $language->code() ?>" lang="<?= $language->code() ?>"<?php if ($kirby->language()->code() === $language->code()): ?> aria-current="true"<?php endif ?>>
      <?= strtoupper($language->code()) ?>
    </a>
  </li>
  <?php endforeach ?>
</ul>
