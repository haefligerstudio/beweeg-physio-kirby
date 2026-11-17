<?php
/*
  Trattamento con icona e nome breve (home, sezione "Cosa faccio"). Tutto il blocco è un link.
  Parametro: $treatment (pagina trattamento). L'icona viene dal modello site/models/treatment.php.
*/
?>
<a class="treatment-link" href="<?= $treatment->url() ?>">
  <img class="treatment-link__icon" src="<?= $treatment->iconUrl() ?>" alt="" width="100" height="98">
  <span class="treatment-link__label"><?= $treatment->label()->esc() ?></span>
</a>
