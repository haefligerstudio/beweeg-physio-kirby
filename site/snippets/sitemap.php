<?php
/*
  Contenuto di /sitemap.xml (rotta in config.php): tutte le pagine pubblicate, home compresa, senza la 404.
  Per ogni pagina, i link alla stessa pagina nelle altre lingue (con una sola lingua c'è solo l'italiano).
  https://getkirby.com/docs/cookbook/content-structure/sitemap
*/
// Chiamato da una rotta, lo snippet non riceve $site e $kirby: si usano site() e kirby().
$site = site();
$kirby = kirby();
$pages = $site->index()->listed()->prepend($site->homePage()->id(), $site->homePage());
?>
<?= '<?xml version="1.0" encoding="utf-8"?>' . "\n" ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
<?php foreach ($kirby->languages() as $language): ?>
<?php foreach ($pages as $item): ?>
  <url>
    <loc><?= esc($item->url($language->code())) ?></loc>
    <lastmod><?= $item->modified('Y-m-d', 'date') ?></lastmod>
<?php foreach ($kirby->languages() as $alternate): ?>
    <xhtml:link rel="alternate" hreflang="<?= $alternate->code() ?>" href="<?= esc($item->url($alternate->code())) ?>"/>
<?php endforeach ?>
  </url>
<?php endforeach ?>
<?php endforeach ?>
</urlset>
