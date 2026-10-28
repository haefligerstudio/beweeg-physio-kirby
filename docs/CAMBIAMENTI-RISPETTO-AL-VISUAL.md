# Colori cambiati rispetto al visual (22 ottobre)

Cambi piccoli, solo per la leggibilità: l'aspetto generale e la palette restano quelli del visual.
Riferimento: **WCAG 2.2 livello AA**. Testo normale ≥ 4,5:1; testo grande (≥ 24px, o ≥ 18,7px in grassetto) ≥ 3:1;
elementi grafici e indicatori di focus ≥ 3:1.

Valori del visual campionati sui pixel dei PDF; palette ufficiale dalla pagina 2 del visual generale:
**#4f7ca3 · #7bacd7 · #a5d0f2 · #3c7bae · #222220 · #ffffff**. I token del sito sono in `assets/css/main.css`.

> Copia per il sito Kirby (23 ottobre) del documento del progetto Next. Aggiunte: le sezioni "Tipografia" e
> "Comportamenti" in fondo.

## Colori cambiati

| Dove | Colore nel visual | Colore usato | Contrasto visual → sito | Motivo |
|---|---|---|---|---|
| Header e footer (sfondo, testo bianco) | #4f7ca3 | #4c7a9c (`--brand`) | 4,43:1 → **4,59:1** | il testo bianco a 15–30px resta sotto 4,5:1; scurito di poco, a occhio identico |
| Pulsanti chiari (sfondo, testo bianco): "scopri di più", "scopri ora", pulsanti delle card | #7bacd7 | #547996 (`--brand-strong`) | 2,41:1 → **4,61:1** | testo bianco non leggibile sul celeste: è il cambio più visibile |
| Pulsante scuro "prenota ora" | #4f7ca3 | #547996 (`--brand-strong`) | 4,43:1 → **4,61:1** | stesso colore degli altri pulsanti: un solo stile di pulsante |
| Titoli sulla banda azzurra ("Dove trovi lo studio", "Dai un'occhiata agli altri trattamenti") | testo #ffffff su #a5d0f2 | testo #005a84 (`--accent-on-tint`) | 1,63:1 → **4,62:1** | il bianco sulla banda non si legge |
| Didascalie dei diplomi sulla banda | testo #ffffff su #a5d0f2 | testo #005a84 | 1,63:1 → **4,62:1** | come sopra (testo a 25px, light nel visual) |
| Testo bianco sulle foto (hero, card trattamenti) | bianco sulla foto | bianco + velo scuro a gradiente | dipendeva dalla foto → stabile | non è un colore nuovo: un velo sotto il testo, perché il contrasto non dipenda dall'immagine |

## Elementi nuovi (non presenti nel visual)

| Dove | Colore | Contrasto | Motivo |
|---|---|---|---|
| Contorno del focus da tastiera | nero #000 (`--focus`) con anello bianco interno | 21:1 sul bianco, 4,6:1 sull'header, l'anello bianco sulle foto scure | **corretto oggi**: prima era arancione #e88000, con 1,64:1 sull'header e 2,79:1 sul bianco (sotto il minimo di 3:1). Nessun colore singolo arriva a 3:1 sia sul bianco sia sul blu, da qui i due toni |
| Riquadri segnaposto (foto di Jan, diplomi) | bordo e X neri (`--color-ink`) su bianco, senza testo | — | come i segnaposto del visual; spariscono da soli quando le foto vengono caricate nel pannello |

## Colori invariati

| Dove | Colore | Contrasto | Nota |
|---|---|---|---|
| Banda azzurra | #a5d0f3 | — | invariato |
| Titoli, numeri e citazione su bianco | #007db6 (`--accent`) | 4,56:1 | nei PDF i titoli campionano #007db6, non il #3c7bae della palette (4,53:1): **da chiarire con Sara** quale dei due è quello giusto. In entrambi i casi il contrasto è sufficiente |
| Testo corrente | #000 su #fff | 21:1 | la palette indica #222220 (15,9:1), le pagine del visual usano il nero: tenuto il nero delle pagine |
| Segnaposto mappa (pin) | #9b1514 (`--pin`) | 8,4:1 | invariato |

## Da far approvare a Sara

1. Pulsanti più scuri (#547996 al posto di #7bacd7): è l'unico cambio che si nota a occhio.
2. Titoli e didascalie sulla banda in blu scuro invece che in bianco.
3. Quale blu per i titoli: #007db6 (pagine) o #3c7bae (palette).

## Tipografia

| Dove | Visual | Sito | Motivo |
|---|---|---|---|
| Interlinea del testo corrente, mobile | circa 1,2 (testo a circa 13,6px) | **1,65** (testo a 18px) | leggibilità: il pubblico è anche anziano, e su schermo piccolo righe più distanziate si seguono meglio. Anche la pagina risulta più lunga del visual |
| Interlinea del testo corrente, desktop (da 1024px) | 1,16 (29px su 25px, tabella a pagina 2) | 1,16, come il visual | **da discutere con il cliente**: è stretta per un pubblico anziano; WCAG 1.4.12 chiede che il sito regga fino a 1,5 |
| Testo del footer, da 768px | circa 30px su desktop (audit) | **16px**, come il menu (`--text-menu`); su mobile resta 18px | richiesta di Sara (regole del 27 ottobre): footer più leggero, stessa misura del menu |

## Comportamenti

| Dove | Visual | Sito | Motivo |
|---|---|---|---|
| Diplomi (Chi sono), mobile | solo didascalie con il link "clicca per visualizzare" | immagini impilate con la didascalia; ogni diploma è un link a una versione grande (circa 2000px), in una nuova scheda | nessun testo nuovo da scrivere e tradurre; il diploma si può ingrandire su ogni schermo. Su desktop stesso comportamento |
| Footer, mobile | due colonne (contatti · orari) | **una colonna**: logo, indirizzo, contatti, orari, icone social in fondo | richiesta di Sara (foto "Footer Mobile" del 27 ottobre) |
| Footer, da 768px | contenitore e spazi del visual | padding 50px, contenitore a tutta larghezza, blocchi a 70px dal logo, orari a destra | regole di Sara (27 ottobre) |
