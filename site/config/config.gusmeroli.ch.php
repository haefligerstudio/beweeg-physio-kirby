<?php

/**
 * Configurazione del sito di prova su https://gusmeroli.ch/beweeg (dominio di Sara).
 * Kirby la legge in più rispetto a config.php solo quando l'host è gusmeroli.ch
 * (https://getkirby.com/docs/guide/configuration). Sul dominio definitivo non ha effetto.
 */
return [
    // Indirizzo fisso, con la sottocartella: Kirby non lo ricava dagli header della richiesta,
    // che un visitatore può falsificare (https://getkirby.com/docs/reference/system/options/url).
    'url' => 'https://gusmeroli.ch/beweeg',

    // Sito di prova: mai su Google, anche se un giorno config.php passasse a true.
    'fisionassa.indexable' => false,
];
