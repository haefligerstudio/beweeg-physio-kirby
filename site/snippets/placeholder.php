<?php
/*
  Riquadro neutro al posto di una foto non ancora arrivata (foto di Jan, diplomi):
  bordo e X come i segnaposto del visual, nessun testo. Sparisce da solo quando la foto viene caricata.
  Parametro: $shape, la forma con le proporzioni del visual:
  'portrait' (foto di Jan, 5:6), 'landscape' (diploma orizzontale A4), 'a4' (diploma verticale A4).
  Le proporzioni stanno nel CSS (classi), non in uno style nell'HTML: così la CSP potrà vietare gli stili inline.
*/
?>
<div class="placeholder placeholder--<?= $shape ?>" aria-hidden="true">
  <svg viewBox="0 0 100 100" preserveAspectRatio="none">
    <path d="M0 0L100 100M100 0L0 100"/>
  </svg>
</div>
