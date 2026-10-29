# Cambiamenti rispetto al visual (aggiornato il 28 ottobre)

Tutto quello che nel sito è diverso dal visual definitivo, con il valore originale, quello usato e il motivo.
Riferimento per i contrasti: **WCAG 2.2 livello AA**. Testo normale ≥ 4,5:1; testo grande (≥ 24px, o ≥ 18,7px in
grassetto) ≥ 3:1; elementi grafici e indicatori di focus ≥ 3:1. I valori del sito sono variabili in `assets/css/main.css`.

Fonti dei colori originali:
- **colori campionati** sui pixel dei PDF del visual;
- **foglio dei valori RGB** (`palette - valori RGB.pdf`, arrivato il 27 ottobre): sei campioni senza indicazione
  di dove si usano. Due sono segnati "colori principali": **#2c7da4** (44,125,164) e **#5ab0d9** (90,176,217);
  gli altri sono #92d1f4 (146,209,244), #007cb1 (0,124,177), nero e bianco. Nel PDF i colori disegnati sono un po'
  diversi dai valori scritti. Quale campione va su header, footer, pulsanti e banda è una domanda aperta a Sara.
- **regole di Sara** (`beweeg_custom.css`, 27 ottobre) per header, pulsanti, layout, footer.

## 1. Colori

La colonna "Foglio RGB" indica il campione più vicino, non un abbinamento deciso.

| Dove | Visual (campionato) | Foglio RGB (più vicino) | Usato nel sito | Contrasto | Motivo |
|---|---|---|---|---|---|
| Header e footer (sfondo, testo bianco) | #4f7ca3 (4,43:1) | #2c7da4 (4,59:1) | **#4c7a9c** `--color-brand` | bianco **4,59:1** | il colore del visual resta sotto 4,5:1 con il testo bianco a 15–30px; scurito di poco, a occhio identico |
| Pulsanti (sfondo, testo bianco) | #7bacd7 (2,41:1) | #5ab0d9 (2,43:1) | **#547996** `--button-bg` | bianco **4,61:1** | il bianco sul celeste non si legge: è il cambio più visibile. Sara propone #79acd7 (2,42:1): vedi "Da decidere" |
| Pulsanti, hover | #4f7ca3 (Sara: #4f7ca2, 4,43:1) | — | **#4c7a9c** `--button-bg-hover` | bianco **4,59:1** | come l'header |
| Bande azzurre | #a5d0f2 | #92d1f4 | **#a5d0f3** `--color-tint` | — | invariato (quasi uguale al visual) |
| Titoli, numeri e citazione su bianco | #007db6 | #007cb1 (4,65:1) | **#007db6** `--color-accent` | **4,56:1** | invariato: è il colore delle pagine del visual. La pagina 2 del visual diceva #3c7bae |
| Titoli e didascalie sulla banda azzurra | bianco (1,63:1) | — | **#005a84** `--color-accent-on-tint` (per ora) | **4,62:1** sulla banda | **in attesa di Sara**, vedi sotto |
| Testo corrente | #000 | nero | **#000** `--color-ink` | 21:1 | invariato |
| Testo bianco sulle foto (apertura, schede) | bianco sulla foto | — | bianco + **velo scuro** a gradiente | stabile su ogni foto | il contrasto non deve dipendere dalla foto (vedi deviazioni) |
| Contorno del focus da tastiera | — (non disegnato) | — | **nero #000** con anello bianco | 21:1 sul bianco, 4,6:1 sull'header | serve per chi usa la tastiera; un solo colore non arriva a 3:1 sia sul bianco sia sul blu |
| Riquadri segnaposto | bordo e X neri | — | bordo e X neri, senza testo | — | come i segnaposto del visual; spariscono quando arrivano le foto |
| Pin della mappa | #9b1514 | — | (non usato: oggi c'è l'iframe di Google Maps) | — | vedi deviazioni |

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
| H1 | "Beweeg physio" su ogni pagina | un solo H1 per pagina: "Beweeg physio" nella home, il titolo del contenuto nelle altre | accessibilità e Google |
| Footer, telefono | solo icone | numero visibile e cliccabile | chi chiama non deve indovinare il numero |
| Diplomi | su mobile solo didascalie con "clicca per visualizzare" | immagini con didascalia; ogni diploma apre una versione grande (circa 2000px) in una nuova scheda | nessun testo nuovo da tradurre; stesso comportamento su ogni schermo |
| Mappa | immagine statica in bianco e nero con pin rosso | oggi: **iframe di Google Maps** (indirizzo sopra solo da 768px) e link "Apri la mappa" | soluzione provvisoria: in un passo successivo sarà sostituita dalla mappa con stile personalizzato (tema chiaro o monocromatico, già arrivato). Finché c'è l'iframe di Google va citato nella privacy |
| Schede dei trattamenti, mobile | "scopri di più" | "scopri ora", come su desktop | un solo testo |
| "Cosa faccio", mobile | (brief: 2 + 2) | una colonna, come il visual mobile | scelta di Amos |
| Prenota | non disegnata | stessi componenti delle altre pagine; contatti e orari sempre visibili | — |
| Testi in tedesco | — | sillabazione automatica solo su titoli ed etichette | parole lunghe in colonne strette |

## In attesa di Sara

Due punti in cui il sito oggi è diverso da quello che Sara ha chiesto o disegnato. Non sono decisi: restano così
finché non ne parliamo.

| Dove | Richiesta o visual | Oggi nel sito | Motivo | Opzioni |
|---|---|---|---|---|
| **Pulsante pausa dello slideshow** | Sara ha chiesto di toglierlo | **c'è ancora** | WCAG 2.2.2: un movimento automatico che dura più di 5 secondi deve potersi fermare. Oggi lo slideshow si ferma anche con il mouse o il focus sopra e non parte con "riduci movimento" | (a) tenerlo così, piccolo nell'angolo; (b) renderlo ancora più discreto (stessa funzione); (c) togliere lo scorrimento automatico: niente pausa necessaria, le foto cambiano solo con i pallini |
| **Titoli e didascalie sulla banda azzurra chiara** ("Dove trovi lo studio", "Dai un'occhiata agli altri trattamenti", didascalie dei diplomi) | bianchi sulla banda | **blu scuro #005a84** (4,62:1) | il bianco sulla banda arriva a circa **1,6:1**, molto sotto il minimo (3:1 per i titoli grandi, 4,5:1 per le didascalie) | (a) blu scuro, come oggi; (b) bianco su una banda più scura; (c) bianco con una banda che resta chiara ma un'ombra o un fondo sotto il testo |

## Da decidere con Sara

1. **Quale campione del foglio dei valori RGB va dove?** Il foglio ha sei campioni senza indicazione d'uso (due segnati
   "colori principali"), e i colori disegnati nel PDF sono un po' diversi dai valori scritti. Oggi il sito usa i colori
   misurati nel visual, ritoccati per il contrasto.
   *Proposta (mia, da valutare):* usare **#2c7da4** per header, footer e pulsanti. Con il testo bianco arriva a 4,59:1,
   quindi è sufficiente, e un solo blu prenderebbe il posto di #4c7a9c (header e footer) e #547996 (pulsanti).
2. **Pulsanti chiari (#79acd7, proposta di Sara, o #5ab0d9 dal foglio RGB)?** Con il testo bianco arrivano a 2,4:1,
   sotto il minimo di 4,5:1. Si potrebbero usare solo con il testo scuro (nero su #5ab0d9: 8,65:1).
3. **Blu dei titoli:** #007db6 (pagine del visual), #007cb1 (foglio RGB) o #3c7bae (pagina 2 del visual): tutti
   sufficienti su bianco.
4. **Interlinea del testo su desktop** (1,16, stretta per un pubblico anziano) e **peso del testo** (normale o light).
5. **Pulsante pausa e titoli sulla banda:** vedi "In attesa di Sara".
