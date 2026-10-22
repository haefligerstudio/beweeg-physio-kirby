/*
  Menu mobile.
  Senza questo file il sito funziona lo stesso: il menu resta visibile sotto il logo (vedi main.css).
*/

// Subito, prima che la pagina venga disegnata: il CSS sa che il JavaScript c'è
// e su mobile può chiudere il menu dietro al pulsante senza far lampeggiare la pagina.
document.documentElement.classList.add('js');

document.addEventListener('DOMContentLoaded', function () {
  const button = document.querySelector('.menu-toggle');
  const menu = document.getElementById('menu');

  if (!button || !menu) {
    return;
  }

  // Quello che sta sotto il pannello aperto: con "inert" non si raggiunge con Tab
  // e gli screen reader non lo leggono, così il focus resta dentro il menu.
  const background = document.querySelectorAll('.skip-link, .site-header__logo, main, .site-footer');

  function isOpen() {
    return button.getAttribute('aria-expanded') === 'true';
  }

  function setOpen(open) {
    button.setAttribute('aria-expanded', String(open));
    button.setAttribute('aria-label', open ? button.dataset.labelClose : button.dataset.labelOpen);
    menu.classList.toggle('is-open', open);
    // La pagina sotto il pannello non deve scorrere.
    document.documentElement.classList.toggle('menu-open', open);
    background.forEach(function (element) {
      element.inert = open;
    });
  }

  function openMenu() {
    setOpen(true);
    menu.querySelector('a').focus();
  }

  // Chiudendo con il pulsante o con Esc il focus torna al pulsante, per non perdersi nella pagina.
  function closeMenu(returnFocus) {
    setOpen(false);
    if (returnFocus) {
      button.focus();
    }
  }

  button.hidden = false;

  button.addEventListener('click', function () {
    if (isOpen()) {
      closeMenu(true);
    } else {
      openMenu();
    }
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && isOpen()) {
      closeMenu(true);
    }
  });

  // Clic su una voce: il menu si chiude mentre si apre la nuova pagina.
  menu.addEventListener('click', function (event) {
    if (event.target.closest('a')) {
      closeMenu(false);
    }
  });

  // Se la finestra si allarga fino al menu in riga, il pannello non deve restare aperto.
  window.matchMedia('(min-width: 48rem)').addEventListener('change', function (event) {
    if (event.matches && isOpen()) {
      closeMenu(false);
    }
  });
});
