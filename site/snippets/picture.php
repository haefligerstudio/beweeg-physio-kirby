<?php
/*
  Foto responsive, uguale per tutto il sito (slideshow, schede dei trattamenti, foto di Jan, diplomi).
  Kirby crea le misure dei preset di config.php (thumbs.srcsets) alla prima visita e le tiene in media/.
  WebP solo se il server lo supporta (opzione fisionassa.webp), JPEG sempre come riserva.
  https://getkirby.com/docs/cookbook/performance/responsive-images

  Parametri: $image (la foto), $srcset (nome del preset), $sizes (larghezza a schermo),
  $width (misura di riferimento per width/height), $lazy (true per le foto non subito visibili),
  $decorative (true: alt vuoto, quando il testo accanto dice già tutto, come nelle schede dei trattamenti).
*/
$reference = $image->resize($width);
$alt = ($decorative ?? false) ? '' : $image->alt()->esc('attr');
?>
<picture>
  <?php if (option('fisionassa.webp')): ?>
  <source type="image/webp" srcset="<?= $image->srcset($srcset . '-webp') ?>" sizes="<?= $sizes ?>">
  <?php endif ?>
  <img src="<?= $reference->url() ?>"
       srcset="<?= $image->srcset($srcset) ?>"
       sizes="<?= $sizes ?>"
       width="<?= $reference->width() ?>"
       height="<?= $reference->height() ?>"
       alt="<?= $alt ?>"
       <?= $lazy ? 'loading="lazy"' : 'fetchpriority="high"' ?>>
</picture>
