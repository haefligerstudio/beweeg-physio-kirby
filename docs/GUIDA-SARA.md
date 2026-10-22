# Guida per Sara (bozza)

Questa guida verrà completata alla consegna (K11): cosa caricare, permessi, licenza, primo accesso e backup.
Per ora contiene solo le verifiche da fare sul server.

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
