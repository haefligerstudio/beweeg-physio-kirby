<?php

/**
 * Metodi in più per $site, usati da più template (un'unica regola, scritta una volta).
 * https://getkirby.com/docs/reference/plugins/extensions/site-methods
 */

Kirby::plugin(
    name: 'fisionassa/metodi-sito',
    extends: [
        'siteMethods' => [
            // Numero di telefono per i link tel:, senza spazi ("+41 77 452 17 64" → "+41774521764").
            // Nel pannello il numero si scrive come deve apparire; qui si ricava quello da comporre.
            // Usato da footer.php, book.php e schema.php.
            'phoneLink' => function (): string {
                return str_replace(' ', '', $this->phone()->value());
            },
        ],
    ]
);
