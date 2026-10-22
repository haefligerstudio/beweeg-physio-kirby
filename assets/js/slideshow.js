/*
  Slideshow dell'apertura (snippet slideshow.php).
  Senza questo file si vede solo la prima foto. Con questo file:
  - le foto cambiano ogni 6 secondi;
  - si fermano con il pulsante pausa, con il mouse sopra e con il focus dentro;
  - con "riduci movimento" attivo nel sistema non partono da sole (si avviano con il pulsante).
*/

const INTERVAL = 6000;

document.querySelectorAll('[data-slideshow]').forEach(function (slideshow) {
  const slides = slideshow.querySelectorAll('.slideshow__slide');
  const dots = slideshow.querySelectorAll('.slideshow__dot');
  const pauseButton = slideshow.querySelector('.slideshow__pause');

  if (slides.length < 2) {
    return;
  }

  // Il testo dell'apertura sta sopra le foto: anche lì il mouse e il focus devono fermarle.
  const area = slideshow.parentElement;
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  let current = 0;
  let timer = null;
  let pausedByUser = reduceMotion;
  let hovered = false;
  let focused = false;

  function show(index) {
    current = index;
    slides.forEach(function (slide, i) {
      slide.classList.toggle('is-active', i === index);
      // Lo screen reader legge solo la foto visibile.
      slide.setAttribute('aria-hidden', String(i !== index));
    });
    dots.forEach(function (dot, i) {
      if (i === index) {
        dot.setAttribute('aria-current', 'true');
      } else {
        dot.removeAttribute('aria-current');
      }
    });
  }

  // Avvia o ferma il cambio automatico in base a pausa, mouse e focus.
  function update() {
    clearInterval(timer);
    timer = null;
    if (!pausedByUser && !hovered && !focused) {
      timer = setInterval(function () {
        show((current + 1) % slides.length);
      }, INTERVAL);
    }
  }

  function setPausedByUser(paused) {
    pausedByUser = paused;
    pauseButton.classList.toggle('is-paused', paused);
    pauseButton.setAttribute('aria-label', paused ? pauseButton.dataset.labelPlay : pauseButton.dataset.labelPause);
    update();
  }

  pauseButton.addEventListener('click', function () {
    setPausedByUser(!pausedByUser);
  });

  dots.forEach(function (dot, i) {
    dot.addEventListener('click', function () {
      show(i);
    });
  });

  area.addEventListener('mouseenter', function () { hovered = true; update(); });
  area.addEventListener('mouseleave', function () { hovered = false; update(); });
  area.addEventListener('focusin', function () { focused = true; update(); });
  area.addEventListener('focusout', function (event) {
    // Il focus passa da un comando all'altro dentro l'apertura: resta fermo.
    if (!area.contains(event.relatedTarget)) {
      focused = false;
      update();
    }
  });

  slideshow.querySelector('.slideshow__controls').hidden = false;
  setPausedByUser(pausedByUser);
});
