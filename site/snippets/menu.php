<?php
/*
  Menu principale: le pagine pubblicate del sito, nell'ordine del pannello.
  Su desktop è in riga nell'header; su mobile (con JavaScript) diventa un pannello a tutto schermo,
  con in più le icone social come nel visual.
*/
?>
<nav class="menu" id="menu" aria-label="<?= esc(t('a11y.mainNav'), 'attr') ?>">
  <ul class="menu__list">
    <?php foreach ($site->children()->listed() as $item): ?>
    <li>
      <?php
      // Pagina corrente → "page". Se siamo in una sua sottopagina (es. un trattamento)
      // la voce resta evidenziata con "true": è nel percorso, ma non è la pagina aperta.
      // https://getkirby.com/docs/reference/objects/cms/page/is-open
      $current = $item->isActive() ? 'page' : ($item->isOpen() ? 'true' : null);
      // data-label: il CSS ne fa una copia invisibile in grassetto che riserva la larghezza,
      // così il grassetto (hover, pagina corrente) non sposta le voci vicine.
      ?>
      <a class="menu__link" href="<?= $item->url() ?>" data-label="<?= $item->title()->esc() ?>"<?php if ($current): ?> aria-current="<?= $current ?>"<?php endif ?>>
        <?= $item->title()->esc() ?>
      </a>
    </li>
    <?php endforeach ?>
  </ul>

  <?php snippet('language-switch') ?>

  <div class="menu__social">
    <?php snippet('social') ?>
  </div>
</nav>
