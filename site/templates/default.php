<?php
/*
  Template di riserva: Kirby lo usa per ogni pagina che non ha un template con il suo nome,
  per questo non va cancellato (https://getkirby.com/docs/guide/templates/basics).
  Per ora serve anche alla home e alla pagina di errore.
*/
?>
<?php snippet('header') ?>

<h1><?= $page->title()->esc() ?></h1>
<?= $page->text()->kt() ?>

<?php snippet('footer') ?>
