<?php
/*
  Foto responsive, uguale per tutto il sito. Kirby crea le misure dei preset in config.php.
  WebP solo se il server lo supporta (opzione beweeg.webp), JPEG sempre come riserva.
  https://getkirby.com/docs/cookbook/performance/responsive-images

  Parametri: $image (la foto), $srcset (nome del preset), $sizes (larghezza a schermo),
  $width (misura di riferimento per width/height), $lazy (true per le foto non subito visibili).
*/
$reference = $image->resize($width);
?>
<picture>
  <?php if (option('beweeg.webp')): ?>
  <source type="image/webp" srcset="<?= $image->srcset($srcset . '-webp') ?>" sizes="<?= $sizes ?>">
  <?php endif ?>
  <img src="<?= $reference->url() ?>"
       srcset="<?= $image->srcset($srcset) ?>"
       sizes="<?= $sizes ?>"
       width="<?= $reference->width() ?>"
       height="<?= $reference->height() ?>"
       alt="<?= $image->alt()->esc('attr') ?>"
       <?= $lazy ? 'loading="lazy"' : 'fetchpriority="high"' ?>>
</picture>
