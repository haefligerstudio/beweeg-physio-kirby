<?php
/*
  Template di riserva: Kirby lo usa per ogni pagina che non ha un template con il suo nome,
  per questo non va cancellato (https://getkirby.com/docs/guide/templates/basics).
  Il titolo della pagina è l'unico H1.
*/
?>
<?php snippet('layout', slots: true) ?>
  <div class="container">
    <h1><?= $page->title()->esc() ?></h1>
  </div>
<?php endsnippet() ?>
