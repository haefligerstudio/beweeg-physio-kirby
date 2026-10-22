# Beweeg physio · sito Kirby

Sito vetrina di uno studio di fisioterapia e osteopatia a Tesserete (Ticino). Cliente finale: Johannes "Jan" de Wild.
Lavoro di Amos Haefliger (HaefligerStudio) per lo studio grafico di Sara, che ha disegnato il visual.
Pubblico: pazienti locali, molti anziani o con difficoltà motorie, e i loro familiari.

**Stack**: Kirby 5 (oggi 5.6.1), PHP 8.3, contenuti in file. Nessun database, nessun Node, nessuna build.
Hosting: server di Sara su Hostpoint, caricamento via FTP/SFTP.

## Progetto di riferimento (solo lettura)

`../beweeg-physio` è il vecchio progetto Next.js. **Non si modifica mai**: si legge e basta.

| File | A cosa serve |
|---|---|
| `DESIGN.md` | direzione, palette, tipografia, deviazioni dal visual già decise |
| `docs/visual/` | il visual in JPG: `desktop-1..8`, `mobile-1..8`, `mobile-menu-1`, `flow-1..2` |
| `docs/visual/flow-2.jpg` | tabella ufficiale di font e misure, palette, logo |
| `docs/AUDIT-TIPOGRAFIA.md` | misure di font e spaziature, desktop (1140px) e mobile (320px) |
| `docs/CAMBIAMENTI-RISPETTO-AL-VISUAL.md` | colori cambiati per il contrasto, con valori e motivi |
| `docs/MATERIALE.md` | materiale mancante e incoerenze ancora aperte |
| `content/it.json` | testi italiani approvati |
| `app/globals.css` | token di colore e scala tipografica |
| `app/fonts/` · `public/` | font con licenza, logo, icone, foto |

## Regole

### 1. Il visual è definitivo
Si implementa, non si ridisegna. Prima di toccare una pagina guarda i JPG del visual (desktop e mobile).
Le sole deviazioni ammesse sono quelle già scritte in `DESIGN.md` e in `CAMBIAMENTI-RISPETTO-AL-VISUAL.md`
(contrasto, corpo 18px su mobile, pausa dello slideshow, un H1 per pagina…). Ogni nuova differenza dal visual
si chiede prima e, se approvata, si annota in `docs/CAMBIAMENTI-RISPETTO-AL-VISUAL.md`.

### 2. Testi mai inventati
- Nessun testo, numero, nome, titolo professionale, claim clinico, orario o zona servita scritto da te.
- I testi italiani di `content/it.json` sono approvati: non si riscrivono e non si "correggono" (anche i refusi noti,
  vedi `MATERIALE.md`, si decidono con il cliente).
- Se un testo manca: `[DA FORNIRE]` ben visibile e segnalalo nella risposta.
- Le etichette del pannello (nomi dei campi, aiuti) le puoi scrivere tu: non sono contenuto del sito.

### 3. Codice semplice
- Scritto come lo scriverebbe un junior pulito: nomi chiari, file piccoli, niente trucchi, niente astrazioni "per il futuro".
- Commenti brevi **in italiano** che spiegano il **perché**, non il cosa.
- Prima un template o uno snippet già esistente, poi uno nuovo. Niente codice duplicato o morto.
- PHP compatibile con 8.3 (in locale gira 8.4: non usare funzioni nuove di 8.4).
- Un solo H1 per pagina; HTML semantico; testi sempre dal pannello o dalle impostazioni del sito, mai scritti nel template.

### 4. CSS
- **Un solo file CSS** in `assets/css/` con le variabili in `:root`. Nessun framework (niente Tailwind, Bootstrap…).
- Colori e misure solo tramite variabili; i valori vengono da `app/globals.css` e dagli audit, non dalla memoria.
- Font: solo Roboto (locale) e Reenie Beanie (solo la citazione di Jan), con le licenze accanto ai file.
- JavaScript minimo, in un file in `assets/js/`, solo dove serve (menu mobile, slideshow).

### 5. Nessuna dipendenza inutile
Niente plugin Kirby, pacchetti Composer, CDN o script esterni se il risultato si ottiene con Kirby e poche righe.
Se una dipendenza sembra davvero necessaria, chiedi prima spiegando perché.

### 6. Consegnabile via FTP così com'è
- Il sito deve funzionare caricando i file sul server: nessun comando da eseguire online (niente Composer, npm, build).
- Il motore di Kirby (`kirby/`) e tutto ciò che `index.php` richiede fanno parte del sito.
- Configurazione separata per sviluppo e produzione; **debug spento in produzione**.
- **noindex** su tutto finché Amos non decide di pubblicare (una sola opzione in configurazione).
- Non fanno parte della consegna: `CLAUDE.md`, `docs/`, `scripts/`, `.claude/`, `.git`, file `.env`,
  account utenti, sessioni, cache, media generati, licenza locale.

### 7. Multilingua attivo, per ora solo italiano
- Il multilingua di Kirby è attivo con la sola lingua `it`. Inglese e tedesco arriveranno dopo.
- Slug italiani: `chi-sono`, `trattamenti` (`osteopatia`, `terapia-del-cuore`, `ortopedia`, `cure-palliative`),
  `servizio-a-domicilio`, `prenota`.
- Ogni testo di interfaccia (menu, pulsanti, etichette accessibili) passa dal sistema di traduzioni di Kirby,
  così aggiungere una lingua non richiede di toccare i template.
- Selettore lingua nascosto finché c'è una sola lingua attiva.
- Non importare né tradurre EN/DE finché non è richiesto: sono bozze del cliente da validare.

### 8. Kirby: documentazione ufficiale, non memoria
Prima di usare un campo, un metodo, un'opzione di configurazione o una funzione del pannello, controllala su
**getkirby.com/docs** (guide, reference, cookbook) per Kirby 5. Non fidarti della memoria: le versioni cambiano.
Quando proponi qualcosa di Kirby, indica la pagina della documentazione da cui l'hai presa.
Non usare Kirby 6 beta.

### 9. Mai credenziali nel repo
Password, utenti del pannello, dati FTP/SFTP, chiavi, file di licenza e `.env` non vanno mai in file tracciati,
nei commenti o nei messaggi di commit. Prima di ogni commit controlla `git status`.
Se ti serve un valore segreto, chiedilo e usa un file escluso da Git.

## Standard minimi
Contrasto WCAG AA, navigazione da tastiera, focus visibile, `prefers-reduced-motion` rispettato, tap target ≥ 44px,
corpo del testo ≥ 18px. Animazioni solo funzionali (200-300 ms, ease-out). Nessuno scroll orizzontale a nessuna larghezza.
Nessun dato di pazienti, nessun form con dati clinici, nessun cookie non tecnico.
Obiettivi Lighthouse mobile: Performance ≥ 90, Accessibilità ≥ 95, Best Practices ≥ 95, SEO 100.

## Comandi
```
php -S localhost:8000 kirby/router.php     # sito:     http://localhost:8000
                                           # pannello: http://localhost:8000/panel
```

## Come lavorare
- Un passo alla volta, seguendo la guida operativa (`../../PIPELINE.md`, prompt K0…K11).
- Per i passi grandi, prima il piano, poi il codice.
- Se qualcosa non è chiaro (materiale, testi, decisioni del cliente), chiedi invece di supporre.
- Commit e push li fa Amos, salvo richiesta esplicita.

## Stato
K1 e K2 fatti: multilingua attivo (solo `it`, URL con `/it`), blueprint di tutte le pagine e della scheda
"Impostazioni sito". K3: testi, foto, dati dello studio e orari importati (`scripts/importa-contenuti.php`).
K4a: layout comune (`site/snippets/layout.php`), header, menu, footer, `assets/css/main.css`, `assets/js/main.js`, font locali.
K4b: home, pagina 404, componenti riusabili (page-intro con slideshow, button, section-heading, band,
lead-text, picture, map). Prossimo passo: K4c (chi sono e trattamenti; lì nasce `treatment-card`). Mancano ancora: foto di Jan, diplomi, mappa statica,
email e social dello studio, strumento di prenotazione, testi legali (vedi `../beweeg-physio/docs/MATERIALE.md`).
