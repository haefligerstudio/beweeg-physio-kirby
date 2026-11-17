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

    // Su un server pubblico Kirby non permette di creare il primo account dal pannello: è già il comportamento
    // di base, qui scritto per chiarezza. Se servisse, metterlo a true solo per il tempo della creazione.
    // https://getkirby.com/docs/reference/system/options/panel
    'panel.install' => false,

    // L'unico interruttore per Google. false: ogni pagina ha "noindex" e robots.txt blocca tutto.
    // Metti true solo quando il cliente approva la pubblicazione (vedi docs/GUIDA-SARA.md).
    'fisionassa.indexable' => false,

    // Indirizzo del sito: qui nessun valore, Kirby lo ricava dalla richiesta (anche in una sottocartella).
    // Ogni server ha il suo file con l'indirizzo fisso, consigliato per sicurezza:
    // config.gusmeroli.ch.php per la prova; config.<dominio>.php quando il dominio definitivo è deciso.
    // https://getkirby.com/docs/reference/system/options/url

    // HSTS (header Strict-Transport-Security, mandato da site/snippets/layout.php solo in HTTPS):
    // per quanto tempo il browser apre il sito solo in HTTPS. Di base 5 minuti, così un dominio non previsto
    // non resta legato all'HTTPS per mesi. Sul dominio definitivo, nel suo file: 'max-age=31536000' (un anno).
    // Niente includeSubDomains né preload senza una decisione: toccano tutto il dominio e toglierli è difficile.
    'fisionassa.hsts' => 'max-age=300',

    // sitemap.xml e robots.txt non sono file: li crea Kirby (snippet sitemap.php e robots.php).
    // Senza l'opzione "language" queste rotte rispondono all'indirizzo senza /it, come vogliono i motori di ricerca.
    // https://getkirby.com/docs/cookbook/content-structure/sitemap
    'routes' => [
        [
            'pattern' => 'sitemap.xml',
            'action' => function () {
                return new Kirby\Cms\Response(snippet('sitemap', [], true), 'application/xml');
            },
        ],
        [
            'pattern' => 'sitemap',
            'action' => function () {
                return go('sitemap.xml', 301);
            },
        ],
        [
            'pattern' => 'robots.txt',
            'action' => function () {
                return new Kirby\Cms\Response(snippet('robots', [], true), 'text/plain');
            },
        ],
    ],

    // Multilingua attivo fin da subito, anche se oggi c'è solo l'italiano:
    // aggiungere inglese e tedesco dopo non cambierà gli indirizzi delle pagine italiane.
    // https://getkirby.com/docs/guide/languages/introduction
    'languages' => true,

    // Chi apre la radice del sito va alla sua lingua, se disponibile (altrimenti all'italiano).
    'languages.detect' => true,

    // Misure delle foto ridimensionate da Kirby per gli srcset (la "w" è la larghezza reale).
    // Le versioni WebP pesano meno; si usano solo se il server sa crearle (vedi 'fisionassa.webp').
    // Lo snippet picture.php riceve il nome del preset ('hero' o 'card') e usa da solo anche la variante '-webp'.
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
    'fisionassa.webp' => function_exists('imagewebp') && (gd_info()['WebP Support'] ?? false),

    // Parser YAML più moderno, già usato dallo Starterkit (https://getkirby.com/docs/reference/system/options/yaml)
    'yaml.handler' => 'symfony',
];
