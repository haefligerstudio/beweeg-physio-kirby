<?php

/**
 * Metodi in più per $site, usati da più template (un'unica regola, scritta una volta).
 * https://getkirby.com/docs/reference/plugins/extensions/site-methods
 */

Kirby::plugin(
    name: 'beweeg/metodi-sito',
    extends: [
        'siteMethods' => [
            // Numero di telefono per i link tel:, senza spazi ("+41 77 452 17 64" → "+41774521764").
            'phoneLink' => function (): string {
                return str_replace(' ', '', $this->phone()->value());
            },
        ],
    ]
);
