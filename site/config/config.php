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

    // Multilingua attivo fin da subito, anche se oggi c'è solo l'italiano:
    // aggiungere inglese e tedesco dopo non cambierà gli indirizzi delle pagine italiane.
    // https://getkirby.com/docs/guide/languages/introduction
    'languages' => true,

    // Chi apre la radice del sito va alla sua lingua, se disponibile (altrimenti all'italiano).
    'languages.detect' => true,

    // Parser YAML più moderno, già usato dallo Starterkit (https://getkirby.com/docs/reference/system/options/yaml)
    'yaml.handler' => 'symfony',
];
