<?php
/*
  Inizio di ogni pagina. Provvisorio: header, menu e CSS arrivano con K4a.
  https://getkirby.com/docs/guide/templates/snippets
*/
?>
<!DOCTYPE html>
<!-- Per ora c'è solo l'italiano; con il multilingua attivo la lingua arriverà da Kirby. -->
<html lang="it">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title><?= $page->title()->esc() ?> · <?= $site->title()->esc() ?></title>
</head>
<body>
  <main>
