<?php

/**
 * Configurazione solo per lo sviluppo in locale (http://localhost:8000).
 * Kirby la legge in più rispetto a config.php quando l'host è "localhost",
 * quindi sul server non ha effetto (https://getkirby.com/docs/guide/configuration).
 */
return [
    // In locale vogliamo vedere gli errori PHP direttamente nella pagina.
    'debug' => true,
];
