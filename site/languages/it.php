<?php

/**
 * Lingua italiana, la lingua principale del sito.
 * Senza l'opzione 'url' gli indirizzi iniziano con /it, come faranno /en e /de.
 * https://getkirby.com/docs/guide/languages/introduction
 *
 * In 'translations' ci sono i testi dell'interfaccia (pulsanti, etichette per
 * screen reader…), presi parola per parola dai testi approvati.
 * Nei template si leggono con t('chiave') e si modificano anche dal pannello,
 * nella sezione Lingue (https://getkirby.com/docs/guide/languages/custom-language-variables).
 */
return [
    'code' => 'it',
    'default' => true,
    'direction' => 'ltr',
    'locale' => 'it_CH.UTF-8',
    'name' => 'Italiano',
    'translations' => [
        // Pulsanti
        'buttons.learnMore' => 'scopri di più',
        'buttons.discover' => 'scopri ora',
        'buttons.book' => 'prenota ora',
        'buttons.treatments' => 'trattamenti',

        // Footer
        'footer.address' => 'Indirizzo',
        'footer.contacts' => 'Contatti',
        // Mostrato negli orari quando un gruppo di giorni non ha fasce orarie.
        'hours.closed' => 'chiuso',

        // Pagina non trovata (404). BOZZA approvata da Amos il 22.10, da confermare con il cliente.
        'error.title' => 'Pagina non trovata',
        'error.text' => 'La pagina che cerchi non esiste o è stata spostata.',
        'buttons.home' => 'torna alla pagina iniziale',

        // Accessibilità: testi letti dagli screen reader
        'a11y.skip' => 'Vai al contenuto',
        'a11y.menuOpen' => 'Apri il menu',
        'a11y.menuClose' => 'Chiudi il menu',
        'a11y.language' => 'Lingua',
        'a11y.slidePause' => 'Metti in pausa la presentazione',
        'a11y.slidePlay' => 'Riprendi la presentazione',
        'a11y.slideGo' => 'Vai all’immagine',
        'a11y.mainNav' => 'Navigazione principale',
        'a11y.home' => 'Beweeg physio, pagina iniziale',

        // Nomi delle icone social, letti dagli screen reader (nel progetto Next erano scritti nel codice)
        'social.facebook' => 'Facebook',
        'social.instagram' => 'Instagram',
        'social.whatsapp' => 'WhatsApp',
        'social.email' => 'Email',

        // Mappa
        'map.open' => 'Apri la mappa',
        'map.alt' => 'Mappa con la posizione dello studio',

        // Segnaposto: si tolgono quando arriva il materiale
        'placeholders.photo' => '[DA FORNIRE] foto di Jan',
        'placeholders.diploma' => '[DA FORNIRE] immagine del diploma',
        'placeholders.map' => '[DA FORNIRE] mappa statica',
    ],
];
