/*
  Widget di prenotazione di SimplyBook.me nella pagina Prenota (caricato solo da book.php).
  widget.js di SimplyBook è caricato prima di questo file; l'indirizzo dell'account viene dal pannello
  (Impostazioni sito → Prenotazione). Colori e lingua si impostano in SimplyBook, non qui.
  La configurazione sta in questo file e non in uno <script> nella pagina perché la CSP vieta gli script inline.
  Il .htaccess permette solo widget.js (script-src) e l'iframe dell'account (frame-src): vedi il punto PRENOTAZIONE.
  Se widget.js non arriva, non succede nulla: il telefono resta nel footer
  (senza JavaScript la pagina lo mostra al posto del widget).
  Privacy (misurato il 17 novembre 2026): SimplyBook riceve l'IP e i dati inseriti dal visitatore; dentro l'iframe
  partono richieste a Google (www.gstatic.com, Firebase) e al contatore di statistiche di SimplyBook
  (counter.simplybook.me, Matomo). Cookie di sessione: "sb_widget" sul nostro dominio (scritto da widget.js)
  e quattro sul dominio di SimplyBook. È descritto nella pagina Privacy: se cambia, va aggiornata anche lei.
*/

document.querySelectorAll('[data-booking-url]').forEach(function (box) {
  if (typeof SimplybookWidget === 'undefined') {
    return;
  }

  const widget = new SimplybookWidget({
    widget_type: 'iframe',
    url: box.dataset.bookingUrl,
    theme: 'belle',
    container_id: box
  });

  // SimplyBook chiama l'iframe "Booking widget" (in inglese): meglio il titolo della pagina, come il contenitore.
  if (widget.frame) {
    widget.frame.title = box.getAttribute('aria-label');
  }
});
