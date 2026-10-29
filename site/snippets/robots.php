<?php
/*
  Testo di /robots.txt (rotta in config.php). Dipende solo dall'opzione beweeg.indexable:
  finché il sito non è pubblicato, i motori di ricerca non devono leggere nessuna pagina.
*/
?>
User-agent: *
<?php if (option('beweeg.indexable')): ?>
Allow: /

Sitemap: <?= url('sitemap.xml') ?>
<?php else: ?>
Disallow: /
<?php endif ?>
