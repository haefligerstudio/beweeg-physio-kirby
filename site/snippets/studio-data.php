<?php
/*
  Dati dello studio nelle pagine Privacy e Note legali (template legal.php), uguali nelle due pagine.
  Tutto dal pannello, scheda "Dati dello studio": se un dato cambia, si cambia lì una volta sola.
  Un campo vuoto mostra [DA FORNIRE]: un dato legale mancante deve restare visibile, non sparire.
*/

// Testo del campo, oppure il segnaposto se è vuoto.
$value = fn ($field) => $field->isNotEmpty() ? $field->esc() : esc(t('placeholders.missing'));

// "6950 Tesserete (Capriasca)": il comune tra parentesi solo se compilato.
$place = $site->zip()->esc() . ' ' . $site->city()->esc();
if ($site->municipality()->isNotEmpty()) {
    $place .= ' (' . $site->municipality()->esc() . ')';
}
?>
<div class="studio-data">
  <p class="studio-data__name"><?= $value($site->legalName()) ?></p>
  <dl class="studio-data__list">
    <div>
      <dt><?= esc(t('studio.owner')) ?></dt>
      <dd><?= $value($site->owner()) ?></dd>
    </div>
    <div>
      <dt><?= esc(t('footer.address')) ?></dt>
      <dd><?= $value($site->street()) ?>, <?= $place ?></dd>
    </div>
    <div>
      <dt><?= esc(t('studio.mobile')) ?></dt>
      <dd>
        <?php if ($site->phone()->isNotEmpty()): ?>
        <a class="studio-data__link" href="tel:<?= esc($site->phoneLink(), 'attr') ?>"><?= $site->phone()->esc() ?></a>
        <?php else: ?>
        <?= esc(t('placeholders.missing')) ?>
        <?php endif ?>
      </dd>
    </div>
    <div>
      <dt><?= esc(t('studio.landline')) ?></dt>
      <dd>
        <?php if ($site->landline()->isNotEmpty()): ?>
        <a class="studio-data__link" href="tel:<?= esc($site->phoneLink('landline'), 'attr') ?>"><?= $site->landline()->esc() ?></a>
        <?php else: ?>
        <?= esc(t('placeholders.missing')) ?>
        <?php endif ?>
      </dd>
    </div>
    <div>
      <dt><?= esc(t('studio.email')) ?></dt>
      <dd>
        <?php if ($site->email()->isNotEmpty()): ?>
        <a class="studio-data__link" href="mailto:<?= $site->email()->esc('attr') ?>"><?= $site->email()->esc() ?></a>
        <?php else: ?>
        <?= esc(t('placeholders.missing')) ?>
        <?php endif ?>
      </dd>
    </div>
    <div>
      <dt><?= esc(t('studio.idi')) ?></dt>
      <dd><?= $value($site->idi()) ?></dd>
    </div>
    <div>
      <dt><?= esc(t('studio.legalForm')) ?></dt>
      <dd><?= $value($site->legalForm()) ?></dd>
    </div>
    <div>
      <dt><?= esc(t('studio.authorization')) ?></dt>
      <dd><?= $value($site->authorization()) ?></dd>
    </div>
  </dl>
</div>
