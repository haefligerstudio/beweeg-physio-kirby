<?php

/**
 * Importa testi e foto del vecchio progetto Next.js (../beweeg-physio) nei contenuti di Kirby.
 * Solo per lo sviluppo: la cartella scripts/ non fa parte della consegna.
 *
 * Uso, dalla cartella del progetto:
 *   php scripts/importa-contenuti.php       → italiano (testi, foto e dati dello studio)
 *   php scripts/importa-contenuti.php en    → inglese: solo testi, titoli e indirizzi delle pagine
 *                                             (serve prima il file site/languages/en.php)
 *
 * Si può rilanciare: i campi vengono riscritti con i testi del JSON, le foto già presenti restano.
 * Alla fine elenca le chiavi del JSON che non sono state importate.
 */

// Mai dal browser: il server di sviluppo di PHP eseguirebbe questo file a chi ne apre l'indirizzo.
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

$lingua = $argv[1] ?? 'it';
$radice = dirname(__DIR__);
$vecchioProgetto = dirname($radice) . '/beweeg-physio';

require $radice . '/kirby/bootstrap.php';

$kirby = new Kirby(['roots' => ['index' => $radice]]);
// Permessi completi senza login: lo script gira solo in locale, da terminale.
$kirby->impersonate('kirby');

if ($kirby->language($lingua) === null) {
    exit("La lingua \"$lingua\" non esiste: crea prima site/languages/$lingua.php\n");
}

// Foto, testi alternativi e dati dello studio sono uguali in tutte le lingue:
// si importano solo con la lingua principale.
$linguaPrincipale = $kirby->defaultLanguage()->code() === $lingua;

$json = json_decode(file_get_contents("$vecchioProgetto/content/$lingua.json"), true, flags: JSON_THROW_ON_ERROR);

// Testi alternativi PROVVISORI (approvati da Amos il 22.10): descrivono le foto stock.
// Da riscrivere quando arrivano le foto vere dello shooting.
// Nel progetto Next le foto non avevano un testo alternativo da importare.
const ALT_PROVVISORI = [
    'slideshow-1.jpg' => 'Fisioterapista con la mano sulla spalla di una paziente che alza il braccio',
    'slideshow-2.jpg' => 'Fisioterapista che esamina la schiena di una paziente seduta sul lettino',
    'slideshow-3.jpg' => 'Paziente sdraiata con gli occhi chiusi, il terapista le sostiene testa e spalla',
    'slideshow-4.jpg' => 'Fisioterapista che tratta il piede di un paziente sul lettino',
    'treatment-1.jpg' => 'Fisioterapista che piega la gamba di un paziente sdraiato sul lettino',
    'treatment-2.jpg' => 'Medico che misura la pressione a una paziente anziana',
    'treatment-3.jpg' => 'Fisioterapista che muove il ginocchio di un paziente sdraiato',
    'treatment-4.jpg' => 'Terapista che sostiene con delicatezza la testa di una paziente anziana sdraiata',
    // Diplomi: PROVVISORI anche questi, da far approvare.
    'diploma-1.jpg' => 'Diploma di fisioterapista di Johannes de Wild, Accademia di fisioterapia di Arnhem, 1985',
    'diploma-2.jpg' => 'Diploma di Herztherapeut SAKR di Johannes de Wild, Berna, 2010',
];

// Diplomi: gli originali del cliente (PNG pesanti) restano fuori dal progetto e non si toccano;
// nella pagina va una copia JPEG con il lato lungo al massimo di LATO_MASSIMO px.
// Il numero è l'ordine nel layout: 1 orizzontale, 2 verticale.
const CARTELLA_DIPLOMI = '/../../00-materiale-cliente/x Amos progresso BIS quasi DEF quasi FINAL/Diplomi';
const DIPLOMI = [
    1 => 'Diploma Fisio Base - Johannes de Wild.png',
    2 => 'Diploma cuore - Johannes de Wild.png',
];
const LATO_MASSIMO = 2400;

// Giorni della settimana come li salva il campo "Giorni" degli orari (gli stessi nomi di site.ts e di Google).
const GIORNI = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

// Trattamenti: id del JSON → indirizzo italiano della pagina e numero della foto (come in TreatmentCard.tsx).
const TRATTAMENTI = [
    'osteopathy' => ['pagina' => 'trattamenti/osteopatia', 'foto' => 1],
    'cardio' => ['pagina' => 'trattamenti/terapia-del-cuore', 'foto' => 2],
    'ortho' => ['pagina' => 'trattamenti/ortopedia', 'foto' => 3],
    'palliative' => ['pagina' => 'trattamenti/cure-palliative', 'foto' => 4],
];

// Chiavi del JSON già usate, per elencare alla fine quelle rimaste fuori.
$usate = [];

// Legge un valore del JSON ("home.about.title") e lo segna come usato.
$testo = function (string $chiave) use ($json, &$usate) {
    $usate[] = $chiave;
    $valore = $json;
    foreach (explode('.', $chiave) as $parte) {
        $valore = $valore[$parte];
    }
    return $valore;
};

// Converte "**testo**" in <strong>, dopo aver protetto i caratteri speciali dell'HTML.
function grassetto(string $testo): string
{
    $testo = htmlspecialchars($testo, ENT_NOQUOTES);
    return preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $testo);
}

// Il campo writer "Testo" vuole un <p> per paragrafo.
function paragrafi(string|array $paragrafi): string
{
    $html = '';
    foreach ((array)$paragrafi as $paragrafo) {
        $html .= '<p>' . grassetto($paragrafo) . '</p>';
    }
    return $html;
}

// Salva i campi di una pagina (o del sito) nella lingua scelta.
function aggiorna(Kirby\Cms\Page|Kirby\Cms\Site $modello, array $campi, string $lingua): void
{
    // Le modifiche lasciate a metà nel pannello coprirebbero i testi importati.
    if ($modello->version('changes')->exists($lingua)) {
        $modello->version('changes')->delete($lingua);
        echo "  (scartate le modifiche non salvate nel pannello)\n";
    }

    $modello->update($campi, $lingua);
}

// Copia una foto nella pagina (o nel sito), se non c'è già, e restituisce il riferimento per i campi file.
// Il testo alternativo (da ALT_PROVVISORI) viene sempre riscritto, la didascalia solo se lo script ne ha una:
// rilanciando non si creano doppioni.
function foto(Kirby\Cms\Page|Kirby\Cms\Site $modello, string $sorgente, string $nome, string $didascalia = ''): string
{
    $alt = ['alt' => ALT_PROVVISORI[$nome]];
    if ($didascalia !== '') {
        $alt['caption'] = $didascalia;
    }
    $file = $modello->file($nome);

    if ($file === null) {
        $file = $modello->createFile([
            'source' => $sorgente,
            'filename' => $nome,
            'template' => 'image',
            'content' => $alt,
        ]);
    } else {
        $file = $file->update($alt);
    }

    return $file->uuid()->toString();
}

// Crea in un file temporaneo una copia JPEG di un'immagine grande, con il lato lungo al massimo di LATO_MASSIMO px.
// Usa GD, la stessa libreria che Kirby usa per le miniature: nessuna dipendenza in più.
function copiaOttimizzata(string $originale): string
{
    $immagine = imagecreatefromstring(file_get_contents($originale));
    $latoLungo = max(imagesx($immagine), imagesy($immagine));
    if ($latoLungo > LATO_MASSIMO) {
        // Con solo la larghezza, imagescale mantiene le proporzioni.
        $immagine = imagescale($immagine, (int)round(imagesx($immagine) * LATO_MASSIMO / $latoLungo));
    }
    $copia = tempnam(sys_get_temp_dir(), 'diploma') . '.jpg';
    imagejpeg($immagine, $copia, 85);
    return $copia;
}

// Titolo e, nelle lingue diverse dall'italiano, indirizzo della pagina.
function titoloEIndirizzo(Kirby\Cms\Page $pagina, string $titolo, ?string $slug, bool $linguaPrincipale, string $lingua): Kirby\Cms\Page
{
    $pagina = $pagina->changeTitle($titolo, $lingua);

    // Gli indirizzi italiani sono i nomi delle cartelle: si cambiano solo quelli tradotti.
    if ($linguaPrincipale === false && $slug !== null) {
        $pagina = $pagina->changeSlug($slug, $lingua);
    }

    return $pagina;
}

$foto = "$vecchioProgetto/public/images";
$siteTs = file_get_contents("$vecchioProgetto/lib/site.ts");
$usate[] = 'lang';

// --- Orari -----------------------------------------------------------------------------

// In site.ts c'è una riga per fascia oraria: { days: ["Monday", …], opens: "08:00", closes: "12:00" }.
// In it.json c'è il testo del footer per gruppi di giorni ("lu–ma e gi–ve" + "08:00 – 12:00\n14:00 – 19:00").
// Nel sito diventano una tabella sola: testo del gruppo, giorni da spuntare e fasce orarie.
echo "Orari\n";
preg_match_all('/days: \[([^\]]*)\], opens: "([^"]+)", closes: "([^"]+)"/', $siteTs, $righeSiteTs, PREG_SET_ORDER);

// Raggruppo le fasce di site.ts per giorni: "Monday,Tuesday,Thursday,Friday" → [08–12, 14–19]
$fascePerGiorni = [];
foreach ($righeSiteTs as [$riga, $giorni, $apre, $chiude]) {
    $giorni = str_replace(['"', ' '], '', $giorni);
    // Il campo "ora" di Kirby salva i secondi: 08:00 → 08:00:00
    $fascePerGiorni[$giorni][] = ['opens' => "$apre:00", 'closes' => "$chiude:00"];
}
$giorniAperti = explode(',', implode(',', array_keys($fascePerGiorni)));

$orari = [];
foreach ($testo('ui.footer.hours') as $numero => $gruppo) {
    // Un gruppo senza orari ("chiuso") prende i giorni che in site.ts non compaiono.
    if (preg_match('/\d/', $gruppo['slots']) === 0) {
        $orari[] = ['label' => $gruppo['days'], 'days' => array_values(array_diff(GIORNI, $giorniAperti)), 'slots' => []];
        if ($gruppo['slots'] !== ($kirby->language($lingua)->translations()['hours.closed'] ?? null)) {
            echo "  manca o è diverso nel file della lingua: hours.closed = \"{$gruppo['slots']}\"\n";
        }
        continue;
    }

    // I gruppi con orari seguono lo stesso ordine di site.ts.
    $giorni = array_key_first($fascePerGiorni);
    $fasce = array_shift($fascePerGiorni);

    // Controllo che il testo del footer e site.ts dicano la stessa cosa.
    $comeNelFooter = implode("\n", array_map(fn($f) => substr($f['opens'], 0, 5) . ' – ' . substr($f['closes'], 0, 5), $fasce));
    if ($comeNelFooter !== $gruppo['slots']) {
        echo "  ATTENZIONE: \"{$gruppo['days']}\" nel footer dice \"{$gruppo['slots']}\", site.ts dice \"$comeNelFooter\"\n";
    }

    $orari[] = ['label' => $gruppo['days'], 'days' => explode(',', $giorni), 'slots' => $fasce];
}
aggiorna($kirby->site(), ['hours' => $orari], $lingua);

// --- Impostazioni sito ---------------------------------------------------------------

if ($linguaPrincipale) {
    echo "Impostazioni sito\n";

    // Legge da site.ts un valore scritto come  chiave: "valore"
    $daSiteTs = function (string $chiave) use ($siteTs): string {
        preg_match('/\b' . $chiave . ': "([^"]*)"/', $siteTs, $trovato);
        return $trovato[1] ?? exit("Non trovo \"$chiave\" in site.ts\n");
    };

    $slideshow = [];
    foreach ([1, 2, 3, 4] as $numero) {
        $slideshow[] = foto($kirby->site(), "$foto/slideshow-$numero.jpg", "slideshow-$numero.jpg");
    }

    $kirby->site()->changeTitle($daSiteTs('name'), $lingua);
    aggiorna($kirby->site(), [
        'street' => $daSiteTs('street'),
        'zip' => $daSiteTs('zip'),
        'city' => $daSiteTs('city'),
        'region' => $daSiteTs('region'),
        'phone' => $daSiteTs('phoneDisplay'),
        'email' => $daSiteTs('email'),
        'whatsapp' => $daSiteTs('whatsapp'),
        'facebook' => $daSiteTs('facebook'),
        'instagram' => $daSiteTs('instagram'),
        'slideshow' => $slideshow,
    ], $lingua);
}

// --- Home ------------------------------------------------------------------------------

echo "Home\n";
// Il grande "Beweeg physio" in cima alle pagine è il titolo del sito, non un campo.
$usate[] = 'home.title';
aggiorna($kirby->page('home'), [
    'tagline' => $testo('home.tagline'),
    'aboutTitle' => $testo('home.about.title'),
    'aboutLead' => grassetto($testo('home.about.lead')),
    'aboutText' => paragrafi($testo('home.about.body')),
    'stats' => $testo('ui.stats'),
    'whatTitle' => $testo('home.whatIDo.title'),
    'visitsTitle' => $testo('home.homeVisits.title'),
    'visitsLead' => grassetto($testo('home.homeVisits.lead')),
    'visitsText' => paragrafi($testo('home.homeVisits.body')),
    'whereTitle' => $testo('home.where.title'),
    'seoTitle' => $testo('seo.home.title'),
    'seoDescription' => $testo('seo.home.description'),
], $lingua);

// --- Chi sono --------------------------------------------------------------------------

echo "Chi sono\n";
$usate[] = 'about.title';
$chiSono = titoloEIndirizzo($kirby->page('chi-sono'), $testo('ui.nav.about'), $testo('routes.about'), $linguaPrincipale, $lingua);

// Diplomi con le didascalie del JSON. Nella lingua principale si copia la foto (se manca) e si riempie il campo;
// nelle altre lingue si traduce solo la didascalia dei diplomi già presenti.
$diplomi = [];
$didascalie = $testo('about.diplomas.captions');
$cartellaDiplomi = $radice . CARTELLA_DIPLOMI;
foreach (DIPLOMI as $numero => $originale) {
    $nome = "diploma-$numero.jpg";
    $didascalia = $didascalie[$numero - 1] ?? '';
    $file = $chiSono->file($nome);

    if ($linguaPrincipale === false) {
        $file?->update(['caption' => $didascalia], $lingua);
        continue;
    }
    if ($file === null && is_file("$cartellaDiplomi/$originale") === false) {
        echo "  diploma $numero: originale non trovato in $cartellaDiplomi, saltato\n";
        continue;
    }
    // La copia ottimizzata serve solo se il diploma non è ancora nella pagina.
    $sorgente = $file === null ? copiaOttimizzata("$cartellaDiplomi/$originale") : '';
    $diplomi[] = foto($chiSono, $sorgente, $nome, $didascalia);
}

$campi = [
    'tagline' => $testo('about.tagline'),
    'heading' => $testo('about.section.title'),
    'text' => paragrafi($testo('about.section.paragraphs')),
    'quote' => $testo('ui.quote.text'),
    'signature' => $testo('ui.quote.signature'),
    'diplomasTitle' => $testo('about.diplomas.title'),
    'seoTitle' => $testo('seo.about.title'),
    'seoDescription' => $testo('seo.about.description'),
];
if ($diplomi !== []) {
    $campi['diplomas'] = $diplomi;
}
aggiorna($chiSono, $campi, $lingua);

// --- Trattamenti -----------------------------------------------------------------------

echo "Trattamenti\n";
$usate[] = 'treatments.title';
$trattamenti = titoloEIndirizzo($kirby->page('trattamenti'), $testo('ui.nav.treatments'), $testo('routes.treatments'), $linguaPrincipale, $lingua);

// "Dai un'occhiata agli altri trattamenti" è ripetuto in ogni trattamento: nel sito si scrive una volta sola.
$altriTrattamenti = array_unique(array_column($testo('treatments.items'), 'more'));
if (count($altriTrattamenti) > 1) {
    echo "  ATTENZIONE: il titolo \"altri trattamenti\" non è uguale in tutti i trattamenti, uso il primo\n";
}

aggiorna($trattamenti, [
    'tagline' => $testo('treatments.tagline'),
    'heading' => $testo('treatments.heading'),
    'moreTitle' => $altriTrattamenti[0],
    'seoTitle' => $testo('seo.treatments.title'),
    'seoDescription' => $testo('seo.treatments.description'),
], $lingua);

foreach ($testo('treatments.items') as $numero => $voce) {
    $dove = TRATTAMENTI[$voce['id']];
    echo '  ' . $dove['pagina'] . "\n";

    $pagina = titoloEIndirizzo($kirby->page($dove['pagina']), $voce['title'], $voce['slug'], $linguaPrincipale, $lingua);
    $campi = [
        'label' => $voce['label'],
        'tagline' => $voce['tagline'],
        'lead' => grassetto($voce['lead']),
        'text' => paragrafi($voce['body']),
    ];
    if ($linguaPrincipale) {
        $campi['photo'] = [foto($pagina, "$foto/treatment-{$dove['foto']}.jpg", "treatment-{$dove['foto']}.jpg")];
    }
    aggiorna($pagina, $campi, $lingua);
}

// Le voci di "Cosa faccio" della home vengono dal "Nome breve" dei trattamenti: controllo che coincidano.
foreach ($testo('home.whatIDo.items') as $voce) {
    $nomeBreve = $kirby->page(TRATTAMENTI[$voce['id']]['pagina'])->content($lingua)->get('label')->value();
    if ($voce['label'] !== $nomeBreve) {
        echo "  ATTENZIONE: in home \"{$voce['label']}\" è diverso dal nome breve \"$nomeBreve\"\n";
    }
}

// --- Servizio a domicilio --------------------------------------------------------------

echo "Servizio a domicilio\n";
$usate[] = 'homeVisits.title';
$domicilio = titoloEIndirizzo($kirby->page('servizio-a-domicilio'), $testo('ui.nav.homeVisits'), $testo('routes.homeVisits'), $linguaPrincipale, $lingua);
aggiorna($domicilio, [
    'tagline' => $testo('homeVisits.tagline'),
    'heading' => $testo('homeVisits.heading'),
    'subheading' => $testo('homeVisits.subheading'),
    'lead' => grassetto($testo('homeVisits.lead')),
    'text' => paragrafi($testo('homeVisits.body')),
    'seoTitle' => $testo('seo.homeVisits.title'),
    'seoDescription' => $testo('seo.homeVisits.description'),
], $lingua);

// --- Prenota ---------------------------------------------------------------------------

echo "Prenota\n";
$prenota = titoloEIndirizzo($kirby->page('prenota'), $testo('ui.nav.book'), $testo('routes.book'), $linguaPrincipale, $lingua);
aggiorna($prenota, [
    'tagline' => $testo('book.tagline'),
    'heading' => $testo('book.title'),
    'intro' => grassetto($testo('book.intro')),
    'fallback' => grassetto($testo('book.fallback')),
    'seoTitle' => $testo('seo.book.title'),
    'seoDescription' => $testo('seo.book.description'),
], $lingua);

// --- Testi dell'interfaccia ------------------------------------------------------------

// Pulsanti, etichette e simili stanno nel file della lingua (site/languages/xx.php):
// qui si controlla solo che siano uguali al JSON.
echo "\nTesti dell'interfaccia (file della lingua)\n";
$traduzioni = $kirby->language($lingua)->translations();
foreach (['buttons', 'footer', 'a11y', 'map', 'placeholders'] as $gruppo) {
    foreach ($json['ui'][$gruppo] as $chiave => $valore) {
        if (is_string($valore) === false) {
            continue; // gli orari (ui.footer.hours) non sono testi dell'interfaccia
        }
        $usate[] = "ui.$gruppo.$chiave";
        if (($traduzioni["$gruppo.$chiave"] ?? null) !== $valore) {
            echo "  manca o è diverso: $gruppo.$chiave = \"$valore\"\n";
        }
    }
}

// --- Riepilogo -------------------------------------------------------------------------

// Elenca tutte le chiavi finali del JSON ("home.about.title") con il loro valore.
function chiaviFinali(array $dati, string $prefisso = ''): array
{
    $chiavi = [];
    foreach ($dati as $chiave => $valore) {
        $percorso = $prefisso === '' ? (string)$chiave : "$prefisso.$chiave";
        if (is_array($valore)) {
            $chiavi += chiaviFinali($valore, $percorso);
        } else {
            $chiavi[$percorso] = $valore;
        }
    }
    return $chiavi;
}

echo "\nChiavi del JSON non importate:\n";
$voceUsata = fn(string $chiave) => array_filter($usate, fn($usata) => str_starts_with("$chiave.", "$usata."));
foreach (chiaviFinali($json) as $chiave => $valore) {
    // Le voci dei trattamenti sono state lette tutte insieme nel ciclo qui sopra.
    $giaLetta = preg_match('/^treatments\.items\.\d+\.(id|slug|label|title|tagline|lead|body|more)/', $chiave);
    if ($giaLetta === 0 && $voceUsata($chiave) === []) {
        echo "  $chiave = " . json_encode($valore, JSON_UNESCAPED_UNICODE) . "\n";
    }
}

echo "\nFatto.\n";
