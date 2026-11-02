# DESIGN.md · Beweeg physio

> Copia per il sito Kirby (23 ottobre) del DESIGN.md del progetto Next, che resta solo come riferimento.
> Qui i token vivono in `assets/css/main.css` e i font in `assets/fonts/`. Le deviazioni nuove sono segnate "(Kirby)".

Fonte: visual definitivo del cliente (`../beweeg-physio/docs/visual/`, PDF originali in `docs/visual-originali/`).
Il file Figma non c'è: i valori sono misurati dai PDF (colori campionati sui pixel, dimensioni misurate e confrontate
con la pagina 2 del visual generale).

## Direzione
- Settore: fisioterapia e osteopatia, Ticino. Pubblico: pazienti locali, molti anziani o con difficoltà motorie, familiari.
- Mood: calmo, rassicurante, umano. Layout: editoriale a sezioni, bande di colore, molta aria, fotografia in primo piano.
- Layout invariato rispetto al visual: hero con slideshow (4 foto, in tutte le pagine), sezioni alternate bianco / banda azzurra,
  bottoni a pillola con freccia, footer blu con logo, indirizzo, contatti e orari.

## Palette
Foglio dei colori di Rebecca (31 ottobre, `00-materiale-cliente/indicazionixcolori_rebecca.pdf`), in `assets/css/main.css`:
- **#2c7da4** `--color-brand`: header, footer, pulsanti in hover (testo bianco 4,59:1);
- **#5aaed9** `--color-button`: pulsanti (il PDF scrive anche RGB 90,176,217, che non coincide: vale l'esadecimale);
- **#92d1f4** `--color-tint`: fondi celesti;
- **#007cb1** `--color-accent`: titoli, numeri, linee tra i numeri, linea sotto i titoli (4,65:1 su bianco);
- **nero** testi, **bianco** sfondo principale.

Due punti diversi dagli standard, con i numeri in **`docs/CAMBIAMENTI-RISPETTO-AL-VISUAL.md`**:
- **deviazione dal foglio:** titoli e testi sui fondi celesti in blu scuro **#005a84** `--color-on-tint` (4,52:1),
  perché il bianco del foglio fa 1,66:1. In attesa di Sara;
- **eccezione di accessibilità decisa dal cliente:** testo dei pulsanti **bianco** su #5aaed9, come nel visual:
  **2,47:1**, sotto il minimo AA di 4,5:1. In hover bianco su #2c7da4, 4,59:1.

Focus da tastiera: nero con anello bianco, visibile su ogni sfondo.

## Tipografia
- Roboto (variabile) + Reenie Beanie (frase a mano), self-hosted in `app/fonts/`.
- Scala ufficiale: pagina 2 del visual generale, confermata misurando i PDF. Valori, misure e confronto col sito:
  **`docs/AUDIT-TIPOGRAFIA.md`**. Desktop (da `lg`): H1 60 · H2 45 · H3 40 light · H4 35 · testo 25/29 · citazione 65.
- Mobile: la tabella non dà valori (tranne citazione 14 e margini 25). Il visual mobile ha il testo a circa 13,6px:
  qui 18px su mobile (pubblico anche anziano), gli altri elementi in proporzione.
- Pesi: 700 titoli e paragrafi guida, 300 sottotitolo hero e parte corsiva dei titoli, 400 testo e pulsanti
  (la tabella dice "Roboto"; nei PDF il testo sembra light: da confermare con Sara).

## Altre deviazioni dal visual (tutte da segnalare a Sara)
- Testo bianco sulle foto (hero, card trattamenti): aggiunto un velo scuro a gradiente, altrimenti il contrasto dipende dalla foto.
- Slideshow: indicatori cliccabili e raggiungibili da tastiera; si ferma con il mouse sopra e con il focus; fermo con
  `prefers-reduced-motion`. **Nessun pulsante pausa**, su richiesta di Sara: eccezione a WCAG 2.2.2 decisa dal cliente
  (vedi `CAMBIAMENTI-RISPETTO-AL-VISUAL.md`, sezione 5).
- Footer: numero di telefono visibile e cliccabile (il visual mostra solo icone). Link a Privacy e Impressum da aggiungere.
- L'H1 non è "Beweeg physio" in ogni pagina (un solo H1 per pagina, titolo del contenuto: serve a Google).
- Pagina Prenota: non disegnata nel visual.
- Bottoni: testo peso 400 (visual 300), stessa logica del corpo; testo mai a capo. Testo bianco come nel visual
  (eccezione di contrasto decisa dal cliente, vedi Palette).
- Home tra 768 e 1023px: statistiche e bottone "scopri di più" impilati come su mobile (in riga non ci stanno).
- Mappa su mobile: il visual non mostra l'indirizzo sopra la mappa; anche qui è solo da md in su (resta nel footer).
- Footer mobile: testo a 18px (visual ≈ 12px), quindi l'indirizzo va a capo nella colonna stretta.
- Didascalie dei diplomi e titolo "Dai un'occhiata agli altri trattamenti": bianco sulla banda nel visual (1,66:1) → `--color-on-tint` (#005a84, 4,52:1).
- Diplomi su mobile (Kirby): il visual mostra solo le didascalie con il link "clicca per visualizzare" (immagine a parte).
  Qui i diplomi sono immagini impilate, ognuna con la sua didascalia; **ogni diploma è un link a una versione grande (circa 2000px)** che si apre
  in una nuova scheda (nome accessibile: didascalia + "si apre in una nuova scheda"). Nessun testo nuovo da tradurre.
  Il link c'è anche su desktop, per avere un solo comportamento. Finché le foto non arrivano: riquadri neutri senza didascalia.
- Card trattamenti su mobile: il visual scrive "scopri di più", su desktop "scopri ora": usato "scopri ora" ovunque.
- Frase "se non c'è movimento non c'è vita · Jan": è testo in **Reenie Beanie** (Google Fonts, OFL), riconosciuto confrontando i glifi:
  a 64px riproduce le righe del visual al pixel (452/368px contro 454/371). `--accent`, interlinea 1, due righe a scalare.
  65px da `lg` (tabella p. 2), 36px da `md`, 24px su mobile (la tabella dice 14px, il visual mobile ne mostra circa 20; proporzionata al corpo di 18px). Il nome del font non è scritto da nessuna parte: **da confermare con Sara**.
- Tedesco: sillabazione automatica solo su titoli ed etichette delle card (`.hyphenate`, `:lang(de)`); ovunque `overflow-wrap: break-word`.
- Testo Chi sono (IT): aggiunti i grassetti come nel visual (`**…**` in `content/it.json`), parole invariate.

## Motion
Solo funzionale: 200-300 ms ease-out; nessuno scroll-jacking; `prefers-reduced-motion` rispettato in ogni animazione.
Spazio per qualcosa in più da portfolio (vedi `docs/PROMPTS.md`, prompt Motion) senza cambiare il layout approvato.

## Segnaposto da sostituire
Foto di Jan (2), diplomi (2), mappa statica (b/n con segnaposto rosso).
