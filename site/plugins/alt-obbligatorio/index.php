<?php

/**
 * Testo alternativo obbligatorio per ogni foto.
 *
 * Kirby controlla il campo "Testo alternativo" solo quando si salva la foto stessa,
 * non quando la si carica: così una foto senza testo alternativo può finire su una pagina.
 * Qui blocchiamo il salvataggio della pagina (o delle Impostazioni sito) finché
 * una delle sue foto non ha il testo alternativo.
 * Hook: https://getkirby.com/docs/reference/plugins/hooks/page-update-before
 */

use Kirby\Cms\ModelWithContent;
use Kirby\Exception\InvalidArgumentException;

// Interrompe il salvataggio se una foto della pagina (o del sito) non ha il testo alternativo.
function beweegControllaAlt(ModelWithContent $model): void
{
    foreach ($model->images() as $image) {
        if ($image->alt()->isEmpty()) {
            throw new InvalidArgumentException(
                'La foto "' . $image->filename() . '" non ha il testo alternativo. ' .
                'Clicca sulla foto, compila "Testo alternativo" e salva; poi salva di nuovo questa pagina.'
            );
        }
    }
}

Kirby::plugin(
    name: 'beweeg/alt-obbligatorio',
    extends: [
        'hooks' => [
            'page.update:before' => function (Kirby\Cms\Page $page) {
                beweegControllaAlt($page);
            },
            // Le foto dello slideshow appartengono al sito, non a una pagina.
            'site.update:before' => function (Kirby\Cms\Site $site) {
                beweegControllaAlt($site);
            },
        ],
    ]
);
