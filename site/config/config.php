<?php

/**
 * Configurazione comune a tutti gli ambienti.
 * Qui vanno solo valori sicuri per la produzione: questo file viene sempre letto,
 * anche sul server, dove non esiste un file per l'host locale.
 * Le opzioni locali stanno in config.localhost.php e sovrascrivono queste.
 * Elenco delle opzioni: https://getkirby.com/docs/reference/system/options
 */
return [
    // Spento di base: sul server pubblico mostrare gli errori PHP è un rischio di sicurezza.
    'debug' => false,

    // Parser YAML più moderno, già usato dallo Starterkit (https://getkirby.com/docs/reference/system/options/yaml)
    'yaml.handler' => 'symfony',
];
