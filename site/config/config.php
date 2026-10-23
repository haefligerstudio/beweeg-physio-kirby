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

    // Misure delle foto ridimensionate da Kirby per gli srcset (la "w" è la larghezza reale).
    // Le versioni WebP pesano meno; si usano solo se il server sa crearle (vedi 'beweeg.webp').
    // https://getkirby.com/docs/cookbook/performance/responsive-images
    'thumbs' => [
        'srcsets' => [
            // Foto di apertura, a tutta larghezza
            'hero' => [
                '640w' => ['width' => 640],
                '960w' => ['width' => 960],
                '1280w' => ['width' => 1280],
                '1920w' => ['width' => 1920],
                '2560w' => ['width' => 2560],
            ],
            'hero-webp' => [
                '640w' => ['width' => 640, 'format' => 'webp'],
                '960w' => ['width' => 960, 'format' => 'webp'],
                '1280w' => ['width' => 1280, 'format' => 'webp'],
                '1920w' => ['width' => 1920, 'format' => 'webp'],
                '2560w' => ['width' => 2560, 'format' => 'webp'],
            ],
            // Foto più piccole: schede dei trattamenti, foto di Jan, diplomi
            'card' => [
                '400w' => ['width' => 400],
                '800w' => ['width' => 800],
                '1200w' => ['width' => 1200],
            ],
            'card-webp' => [
                '400w' => ['width' => 400, 'format' => 'webp'],
                '800w' => ['width' => 800, 'format' => 'webp'],
                '1200w' => ['width' => 1200, 'format' => 'webp'],
            ],
        ],
    ],

    // Il WebP dipende da come è compilata la libreria GD del server: se manca,
    // il sito usa solo JPEG invece di produrre errori. Come verificarlo: docs/GUIDA-SARA.md.
    'beweeg.webp' => function_exists('imagewebp') && (gd_info()['WebP Support'] ?? false),

    // Parser YAML più moderno, già usato dallo Starterkit (https://getkirby.com/docs/reference/system/options/yaml)
    'yaml.handler' => 'symfony',
];
