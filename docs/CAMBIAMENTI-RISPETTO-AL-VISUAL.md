# Cambiamenti rispetto al visual (aggiornato il 17 novembre: nome FisioNassa e logo nuovo)

Tutto quello che nel sito è diverso dal visual definitivo, con il valore originale, quello usato e il motivo.
Riferimento per i contrasti: **WCAG 2.2 livello AA**. Testo normale ≥ 4,5:1; testo grande (≥ 24px, o ≥ 18,7px in
grassetto) ≥ 3:1; elementi grafici e indicatori di focus ≥ 3:1. I valori del sito sono variabili in `assets/css/main.css`.

Fonti dei colori:
- **colori campionati** sui pixel dei PDF del visual;
- **foglio di Rebecca** (`indicazionixcolori_rebecca.pdf`, 31 ottobre): i sei colori del foglio dei valori RGB
  con il loro uso. **#2c7da4** header, footer e pulsanti in hover; **#5aaed9** pulsanti; **#92d1f4** fondi celesti;
  **#007cb1** titoli ed "elementi studio" (numeri, linee tra i numeri, linea sotto i titoli); **nero** testi;
  **bianco** sfondo principale e titoli sui fondi celesti.
  Nota: per i pulsanti il PDF scrive "RGB 90,176,217" e "Hex #5aaed9", che non coincidono (RGB 90,176,217 è #5ab0d9).
  Nel sito vale l'esadecimale **#5aaed9** (RGB 90,174,217); a occhio la differenza non si vede;
- **regole di Sara** (`beweeg_custom.css`, 27 ottobre) per header, pulsanti, layout, footer.

## 1. Colori

Il sito segue il foglio di Rebecca, tranne il punto **a)**: lì il colore del foglio non si legge, quindi si usa
un'alternativa leggibile (vedi "In attesa di Sara"), che si inverte cambiando una sola variabile.
Il testo bianco dei pulsanti segue il foglio, ma è sotto il minimo di contrasto: è un'eccezione decisa dal cliente
(vedi sezione 5).

| Dove | Visual (campionato) | Foglio di Rebecca | Usato nel sito | Contrasto | Motivo |
|---|---|---|---|---|---|
| Header, menu mobile e footer (sfondo, testo bianco) | #4f7ca3 | #2c7da4 | **#2c7da4** `--color-brand` | bianco **4,59:1** | come il foglio |
| Pulsanti (sfondo) | #7bacd7 | #5aaed9 | **#5aaed9** `--color-button` | — | come il foglio |
| Pulsanti (testo) | bianco | bianco | **bianco** `--button-text` | **2,47:1** | come il foglio e il visual, per scelta del cliente: sotto il minimo AA, vedi sezione 5 |
| Pulsanti in hover (sfondo, testo bianco) | #4f7ca3 | #2c7da4 | **#2c7da4** `--button-bg-hover`, testo bianco `--button-text-hover` | **4,59:1** | come il foglio; il testo diventa bianco con lo sfondo scuro |
| Fondi celesti (bande) | #a5d0f2 | #92d1f4 | **#92d1f4** `--color-tint` | — | come il foglio |
| Titoli, numeri, linee tra i numeri, linea sotto i titoli, citazione di Jan (su bianco) | #007db6 | #007cb1 | **#007cb1** `--color-accent` | **4,65:1** | come il foglio |
| Titoli e testi sui fondi celesti ("Dove trovi lo studio", "altri trattamenti", didascalie dei diplomi, indirizzo e link della mappa) | bianco | bianco (1,66:1) | **#005a84** `--color-on-tint` | **4,52:1** | **deviazione a)**: il bianco sul celeste non si legge. Il blu scuro è quello già in uso; sul celeste nuovo arriva al minimo AA (prima 4,62:1 sul celeste del visual) |
| Testo corrente | #000 | nero | **#000** `--color-ink` | 21:1 su bianco, 12,65:1 sul celeste | come il foglio |
| Sfondo principale | #fff | bianco | **#fff** `--color-paper` | — | come il foglio |
| Testo bianco sulle foto (apertura, schede) | bianco sulla foto | — | bianco + **velo scuro** a gradiente | stabile su ogni foto | il contrasto non deve dipendere dalla foto (vedi deviazioni) |
| Contorno del focus da tastiera | — (non disegnato) | — | **nero #000** con anello bianco | 21:1 sul bianco, 4,58:1 sull'header, 8,49:1 sul pulsante | serve per chi usa la tastiera; un solo colore non arriva a 3:1 sia sul bianco sia sul blu |
| Riquadri segnaposto | bordo e X neri | — | bordo e X neri, senza testo | — | come i segnaposto del visual; spariscono quando arrivano le foto |
| Pin della mappa | #9b1514 | — | (non usato: mappa standard di Google) | — | vedi deviazioni |

Bordo dei pulsanti: #5aaed9 fa 2,47:1 sul bianco e 1,49:1 sul celeste. Non serve 3:1, perché il pulsante si riconosce
dal suo testo (WCAG 1.4.11), ma sul fondo celeste il pulsante si stacca poco.

## 2. Tipografia

| Dove | Visual | Sito | Motivo |
|---|---|---|---|
| Testo corrente, mobile | circa 13,6px, interlinea circa 1,2 | **18px**, interlinea **1,65** | pubblico anche anziano: righe più grandi e più distanziate si leggono meglio. La pagina è più lunga del visual |
| Testo corrente, desktop | 25px / 29px (1,16) | 25px / 29px, come il visual | **da discutere**: 1,16 è stretta per un pubblico anziano; WCAG 1.4.12 chiede che il sito regga fino a 1,5 |
| Peso del testo corrente e dei pulsanti | sembra light (300); la tabella dice "Roboto" | **400** (normale) | più leggibile; da confermare con Sara |
| Testo del footer | circa 30px su desktop | **16px** da 768px, come il menu; 18px su mobile | regole di Sara |
| Menu desktop | 15px light | 16px light | +1px per la leggibilità |
| Menu mobile aperto | circa 15px | **20px** (visual × 1,3, come il resto del mobile) | corretto in K4f: prima era 24px |
| Citazione di Jan, mobile | tabella 14px, visual circa 20px | 24px | proporzionata al corpo di 18px |
| Titoli e numeri, mobile | H1 30, H2 20, numeri 41 | H1 36, H2 30, numeri 48 | in proporzione al corpo di 18px |

## 3. Misure e layout

| Dove | Visual | Sito | Motivo |
|---|---|---|---|
| Larghezza del contenuto | 1140px (utile 1040px) | **1400px** (utile 1300px); fino a 1140px di finestra non cambia nulla | regole di Sara; le spaziature verticali dell'audit restano uguali |
| Colonne di testo | circa 500px | **50%** del contenuto da 1024px (520px a 1140, 650px a 1400), 75% da 768px, 100% su mobile | regole di Sara |
| Header | 96px; logo largo 136px | **80px** con logo 70px (5px sopra e sotto) su desktop, 70/60 su tablet, 60/50 su mobile; dopo 120px di scorrimento **60px** con logo 50px (56/46, 50/40); a tutta larghezza | regole di Sara; tablet e mobile in proporzione. La pagina non salta quando l'header si riduce |
| Pulsanti | a pillola | raggio **20px**; freccia che scorre di **8px** in **300ms** (prima 4px, 200ms), ferma con "riduci movimento"; nessun movimento verticale | regole di Sara |
| "Cosa faccio" (home) | icone circa 190px | icone alte **230px** da 1024px, 4 colonne uguali con **30px** di spazio; 2 colonne da 640px; 1 su mobile; niente sottolineatura in hover | regole di Sara |
| Linea sotto i titoli | 80 × 3px | 80 × 3px a **10px** dal titolo, stesso colore del titolo | regole di Sara |
| Footer | due colonne anche su mobile; contenitore del contenuto | mobile **una colonna** (logo, indirizzo, contatti, orari, icone); da 768px padding 50px, a tutta larghezza, blocchi a 70px dal logo | regole e foto "Footer Mobile" di Sara |
| Icone social | dimensioni diverse | tutte alla stessa altezza (28/32/40px), larghezza secondo le proporzioni | icone nuove di Sara (27 ottobre) |

Spaziature verticali: tutte entro circa 10px dal visual (misure da inchiostro a inchiostro, `~/beweeg-checks/distanze.js`).
Corrette in K4f:

| Punto | Visual | Prima | Ora |
|---|---|---|---|
| Home, numeri → titolo "Cosa faccio" | 183px | 167px | 183px |
| Home, trattino "Cosa faccio" → icone | 155px | 128px | 155px |
| Home, icone → etichette (desktop) | 38px | 51px | 39px |
| Home, icona → etichetta (mobile, visual × 1,3) | 44px | 20px | 44px |
| Home, etichetta → icona successiva (mobile) | 85px | 58px | 90px |
| Servizio a domicilio, sottotitolo → testo | 38px | 53px | 37px |

## 4. Deviazioni decise

| Dove | Visual / richiesta | Sito | Motivo |
|---|---|---|---|
| Testi bianchi sulle foto | bianco direttamente sulla foto | velo scuro a gradiente sotto il testo | con foto chiare il bianco non si legge |
| Nome e logo | "Beweeg physio", logo "beweegphysio · studio fisioterapeutico" | **FisioNassa** (scrittura esatta), logo "FisioNassa · Jan de Wild" di Sara (file bianco nell'header e nel footer, a colori nel JSON-LD), copiato senza modifiche. Il nome viene solo dal titolo del sito (pannello): header, footer, titoli delle schede, JSON-LD e testo per gli screen reader lo leggono da lì. Il grande titolo in cima alle pagine diventa "FisioNassa" tutto in grassetto (regola "prima parola in grassetto": è una parola sola, come nel logo) | decisione del cliente, 17 novembre |
| H1 | "Beweeg physio" su ogni pagina | un solo H1 per pagina: il nome dello studio nella home, il titolo del contenuto nelle altre | accessibilità e Google |
| Footer, telefono | solo icone | numero visibile e cliccabile | chi chiama non deve indovinare il numero |
| Diplomi | su mobile solo didascalie con "clicca per visualizzare" | immagini con didascalia; ogni diploma apre una versione grande (circa 2000px) in una nuova scheda | nessun testo nuovo da tradurre; stesso comportamento su ogni schermo |
| Mappa | immagine statica in bianco e nero con pin rosso | **mappa standard di Google incorporata** (iframe), senza stile personalizzato, chiave o Map ID; indirizzo grande sopra solo da 768px; **nessun link "Apri la mappa"** sotto (tolto su decisione del cliente, era stato previsto in K4e-6: dentro la mappa resta "Apri in Maps" di Google) | decisione del cliente, 2 novembre. **Per K6:** la mappa di Google riceve l'IP del visitatore e può usare cookie di Google: va scritto nella pagina Privacy |
| Schede dei trattamenti, mobile | "scopri di più" | "scopri ora", come su desktop | un solo testo |
| "Cosa faccio", mobile | (brief: 2 + 2) | una colonna, come il visual mobile | scelta di Amos |
| Prenota | non disegnata | stessi componenti delle altre pagine; contatti e orari sempre visibili. Widget di **SimplyBook.me** (iframe) a tutta larghezza sotto il pulsante "prenota ora", che resta come riserva (nuova scheda); indirizzo e interruttore in Impostazioni sito → Prenotazione | **Per K6:** SimplyBook riceve l'IP e i dati inseriti dal visitatore; dentro l'iframe partono richieste a Google (gstatic) e al tracker Metricool; widget.js scrive sul nostro dominio il cookie `sb_widget`. Da scrivere nella Privacy |
| Testi in tedesco | — | sillabazione automatica solo su titoli ed etichette | parole lunghe in colonne strette |

## 5. Eccezioni agli standard di accessibilità (decise dal cliente)

Punti in cui il sito resta sotto WCAG 2.2 per scelta esplicita del cliente: su questi punti il sito non è conforme.
La pausa dello slideshow (2.2.2) è un criterio di livello **A**, il più basilare: pesa più del contrasto, che è AA.
Lighthouse misura il contrasto, quindi pesa sull'obiettivo Accessibilità ≥ 95 (da controllare in K8); la pausa no.

| Dove | Standard | Sito | Contrasto | Decisione | Per tornare conformi |
|---|---|---|---|---|---|
| Testo dei pulsanti a riposo | WCAG 1.4.3 (AA): 4,5:1; 3:1 solo per il testo grande, e i pulsanti (18–20px, peso normale) non lo sono | bianco su #5aaed9, come il visual e il foglio di Rebecca | **2,47:1** | il cliente, 2 novembre | testo nero (8,49:1): `--button-text: var(--color-ink)` in `assets/css/main.css` |
| Slideshow dell'apertura: nessun pulsante pausa | WCAG 2.2.2 (A), "Pausa, stop, nascondi": un movimento automatico che dura più di 5 secondi deve avere un comando per fermarlo | pulsante tolto: **richiesta di Sara accolta**. Resta: le foto si fermano con il mouse sopra e con il focus da tastiera (anche sui pallini); i pallini sono cliccabili e raggiungibili con Tab; con "riduci movimento" lo slideshow non parte; senza JavaScript resta la prima foto | — | il cliente, 2 novembre | rimettere il pulsante pausa (codice nella storia di Git, prima di questo cambio) |

In hover il testo resta bianco su #2c7da4: 4,59:1, conforme.

## In attesa di Sara

La deviazione dal foglio di Rebecca. Resta così finché Sara non la approva o sceglie un'altra soluzione.
Per seguire il foglio basta cambiare una variabile in `assets/css/main.css`.

| Punto | Foglio di Rebecca | Oggi nel sito | Contrasto (foglio → sito) | Variabile |
|---|---|---|---|---|
| **a) Titoli e testi sui fondi celesti** | bianco su #92d1f4 | blu scuro **#005a84** | **1,66:1 → 4,52:1** (minimo 3:1 per i titoli grandi, 4,5:1 per didascalie e link) | `--color-on-tint`: per il foglio, `var(--color-paper)` |

## Da decidere con Sara

1. **Interlinea del testo su desktop** (1,16, stretta per un pubblico anziano) e **peso del testo** (normale o light).
