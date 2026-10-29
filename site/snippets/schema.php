<?php
/*
  Dati strutturati dello studio per Google (schema.org "Physiotherapy"), solo nella home.
  Tutto dalle Impostazioni sito: indirizzo, telefono, email, social, orari. L'unico valore fisso è il paese.
  Un blocco application/ld+json non viene eseguito: una CSP su script-src non lo blocca.
  https://schema.org/Physiotherapy
*/

// Orari: una voce per ogni fascia di ogni gruppo, con i giorni spuntati nel pannello (Monday…, i nomi di schema.org).
// I gruppi senza fasce (giorni di chiusura) non si scrivono: per schema.org un giorno assente è chiuso.
$hours = [];
foreach ($site->hours()->toStructure() as $group) {
    foreach ($group->slots()->toStructure() as $slot) {
        $hours[] = [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => $group->days()->split(),
            'opens' => $slot->opens()->toDate('H:i'),
            'closes' => $slot->closes()->toDate('H:i'),
        ];
    }
}

$data = [
    '@context' => 'https://schema.org',
    '@type' => 'Physiotherapy',
    'name' => $site->title()->value(),
    'url' => $site->url(),
    'logo' => url('assets/images/logo-color.svg'),
    'image' => url('assets/images/logo-color.svg'),
    'telephone' => $site->phoneLink(),
    'email' => $site->email()->value(),
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => $site->street()->value(),
        'postalCode' => $site->zip()->value(),
        'addressLocality' => $site->city()->value(),
        'addressRegion' => $site->region()->value(),
        'addressCountry' => 'CH',
    ],
    'openingHoursSpecification' => $hours,
    'sameAs' => array_values(array_filter([$site->facebook()->value(), $site->instagram()->value()])),
];

// Via i campi vuoti: meglio un dato mancante che uno vuoto.
$data = array_filter($data, fn ($value) => $value !== '' && $value !== []);
?>
<script type="application/ld+json"><?= json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?></script>
