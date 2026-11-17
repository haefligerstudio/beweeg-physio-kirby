<?php
/*
  Testo di /robots.txt (rotta in config.php). Dipende solo dall'opzione fisionassa.indexable:
  finché il sito non è pubblicato, i motori di ricerca non devono leggere nessuna pagina.
*/
?>
User-agent: *
<?php if (option('fisionassa.indexable') === true): ?>
Allow: /

Sitemap: <?= url('sitemap.xml') ?>
<?php else: ?>
Disallow: /
<?php endif ?>
