/*
  Numeri della home (caricato solo da home.php, campo "Numeri"): salgono da 0 al valore finale, una volta sola,
  quando la riga dei numeri entra nello schermo (circa il 30%). Si animano solo i valori con data-count,
  cioè fatti di sole cifre: "100%" o "1.000" restano fermi.
  Il valore finale è già scritto nell'HTML: senza questo file, con "riduci movimento" o senza
  IntersectionObserver i numeri restano semplicemente fermi al loro valore.
*/

const DURATION = 1800; // ms

document.querySelectorAll('.stats').forEach(function (stats) {
  const values = stats.querySelectorAll('.stats__value[data-count]');
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (values.length === 0 || reduceMotion || !('IntersectionObserver' in window)) {
    return;
  }

  // Prima di partire si vede 0. Il numero vero resta nella pagina, trasparente (main.css):
  // tiene la larghezza ed è l'unico letto dagli screen reader.
  const counters = [];
  values.forEach(function (value) {
    const counter = document.createElement('span');
    counter.className = 'stats__counter';
    counter.setAttribute('aria-hidden', 'true');
    counter.textContent = '0';
    counters.push({ value: value, counter: counter, target: Number(value.textContent) });
    value.classList.add('is-counting');
    value.append(counter);
  });

  function count(start) {
    requestAnimationFrame(function frame(now) {
      const t = Math.min((now - start) / DURATION, 1);
      const eased = 1 - Math.pow(1 - t, 3); // ease-out: veloce all'inizio, piano alla fine
      counters.forEach(function (item) {
        item.counter.textContent = String(Math.round(item.target * eased));
      });
      if (t < 1) {
        requestAnimationFrame(frame);
        return;
      }
      // Fine: torna visibile il numero vero, identico all'ultimo valore del contatore.
      counters.forEach(function (item) {
        item.counter.remove();
        item.value.classList.remove('is-counting');
      });
    });
  }

  const observer = new IntersectionObserver(function (entries) {
    if (entries[0].isIntersecting) {
      observer.disconnect(); // una volta sola
      count(performance.now());
    }
  }, { threshold: 0.3 });

  observer.observe(stats);
});
