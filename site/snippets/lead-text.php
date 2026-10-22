<?php
/*
  Paragrafo guida (in grassetto) seguito dal testo, come in tutte le sezioni del visual.
  Parametri: $lead e $text, due campi writer.
  I campi writer contengono HTML già ripulito da Kirby al salvataggio: si stampano così come sono
  (https://getkirby.com/docs/reference/panel/fields/writer). Il paragrafo guida è su una riga
  e va messo in un <p>; il testo ha già i suoi <p>.
*/
?>
<div class="lead-text">
  <p class="lead-text__lead"><?= $lead ?></p>
  <div class="lead-text__body"><?= $text ?></div>
</div>
