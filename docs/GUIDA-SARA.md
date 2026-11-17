# Guida per Sara (bozza)

Questa guida verrà completata alla consegna (K11): cosa caricare, permessi, licenza, primo accesso e backup.
Per ora contiene solo le verifiche da fare sul server.

## Caricare gli aggiornamenti: `site/config/` e `site/snippets/` sempre insieme

Le due cartelle dipendono l'una dall'altra: gli snippet leggono le opzioni scritte nei file di configurazione
(per esempio `fisionassa.indexable`, che decide se Google può vedere il sito). Dal 17 novembre 2026 queste opzioni
si chiamano `fisionassa.…` e non più `beweeg.…`: se sul server resta un file di una sola delle due cartelle
nella versione vecchia, il sito non legge più le impostazioni giuste.
Quando carichi una nuova versione, quindi, carica **sempre tutte e due le cartelle intere**, anche se ti sembra
cambiato un solo file. Il file `config.<dominio>.php` del server va aggiornato insieme a loro.

## Dove si cambiano i dati dello studio

Nome completo, titolare, IDI, forma giuridica, autorizzazione cantonale, indirizzo, telefoni ed email stanno in
**un solo punto**: pannello → Sito → scheda **Dati dello studio**. Footer, mappa, dati per Google e le pagine
Privacy e Note legali li leggono da lì: se cambiano, si cambiano una volta sola.
Il telefono fisso compare solo nelle pagine Privacy e Note legali; header e footer mostrano il cellulare.
Finché forma giuridica e autorizzazione cantonale sono vuote, le pagine legali mostrano [DA FORNIRE].

## Verificare se il server crea immagini WebP

Il sito mostra le foto in formato WebP (più leggero) solo se il server lo supporta.
Se non lo supporta usa automaticamente il JPEG: il sito funziona lo stesso, è solo un po' più lento da caricare.

Per sapere quale dei due casi vale sul server:

1. Crea sul tuo computer un file di testo chiamato `verifica-php.php` con dentro solo questa riga:

   ```php
   <?php phpinfo();
   ```

2. Caricalo con il programma FTP nella cartella principale del sito (la stessa di `index.php`).
3. Apri nel browser `https://indirizzo-del-sito/verifica-php.php`.
4. Cerca nella pagina (Cmd+F o Ctrl+F) la sezione **gd** e la riga **WebP Support**:
   - `enabled`: le foto WebP funzionano;
   - riga assente o `disabled`: il sito userà solo JPEG. Se vuoi il WebP, chiedi a Hostpoint di attivarlo.
5. **Cancella subito `verifica-php.php` dal server.** Quella pagina mostra a chiunque i dettagli
   del server (versioni, percorsi, configurazione): è un'informazione utile a chi vuole attaccarlo.

Nella stessa pagina puoi controllare anche la riga **PHP Version** in alto: il sito richiede PHP 8.3 o più recente.

## Pubblicare il sito su Google

Finché il cliente non approva, il sito resta nascosto ai motori di ricerca: ogni pagina dice "non indicizzare"
e `robots.txt` blocca tutto. Si cambia con **una sola riga**.

1. Apri `site/config/config.php` e cambia `'fisionassa.indexable' => false` in `'fisionassa.indexable' => true`.
2. Il dominio definitivo ha il suo file di configurazione, `site/config/config.<dominio>.php`
   (sul modello di `config.gusmeroli.ch.php`), con `'url' => 'https://…'` scritto per intero:
   così tutti i link per Google usano il dominio giusto. Senza quel file Kirby ricava l'indirizzo dalla richiesta.
3. Carica il file sul server e controlla nel browser `https://indirizzo-del-sito/robots.txt`:
   deve dire `Allow: /` e indicare la sitemap.
4. In Google Search Console aggiungi il sito e invia la sitemap: `https://indirizzo-del-sito/sitemap.xml`.
