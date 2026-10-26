<?php
/*
  Orari dalla tabella "Orari" delle Impostazioni sito: testo dei giorni e fasce orarie.
  Un gruppo senza fasce è un giorno di chiusura.
*/
if ($site->hours()->toStructure()->isEmpty()) {
    return; // tabella vuota: niente <dl> vuota nella pagina
}
?>
<dl class="hours">
  <?php foreach ($site->hours()->toStructure() as $group): ?>
  <?php
  // "08:00 – 12:00", una fascia per riga; se non ce ne sono, "chiuso".
  $slots = [];
  foreach ($group->slots()->toStructure() as $slot) {
      $slots[] = $slot->opens()->toDate('H:i') . ' – ' . $slot->closes()->toDate('H:i');
  }
  if ($slots === []) {
      $slots[] = esc(t('hours.closed'));
  }
  // Word joiner (U+2060) attorno al trattino: "lu–ma" non va mai a capo a metà.
  $days = str_replace('–', "\u{2060}–\u{2060}", $group->label()->esc());
  ?>
  <div class="hours__group">
    <dt class="hours__days"><?= $days ?></dt>
    <dd class="hours__slots"><?= implode('<br>', $slots) ?></dd>
  </div>
  <?php endforeach ?>
</dl>
