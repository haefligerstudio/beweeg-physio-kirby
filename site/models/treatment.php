<?php

use Kirby\Cms\Page;

/**
 * Metodi in più per le pagine "trattamento".
 * https://getkirby.com/docs/guide/templates/page-models
 */
class TreatmentPage extends Page
{
    // Icona di ogni trattamento: nome della cartella della pagina → file in assets/icons/treatments.
    // È l'unico posto da aggiornare se arriva un trattamento nuovo.
    private const ICONS = [
        'osteopatia' => 'osteopathy.svg',
        'terapia-del-cuore' => 'cardio.svg',
        'ortopedia' => 'ortho.svg',
        'cure-palliative' => 'palliative.svg',
    ];

    public function iconUrl(): string
    {
        // uid() è il nome della cartella: resta uguale anche quando l'indirizzo è tradotto.
        return url('assets/icons/treatments/' . self::ICONS[$this->uid()]);
    }
}
