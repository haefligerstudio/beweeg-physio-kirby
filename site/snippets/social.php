<?php
/*
  Icone social bianche (menu mobile e footer). Si vedono solo i link compilati
  nelle Impostazioni sito.
*/

// campo del pannello => indirizzo, nome per gli screen reader, icona
$links = [
    ['url' => $site->facebook()->value(), 'name' => t('social.facebook'), 'icon' => 'facebook'],
    ['url' => $site->instagram()->value(), 'name' => t('social.instagram'), 'icon' => 'instagram'],
    ['url' => $site->whatsapp()->value(), 'name' => t('social.whatsapp'), 'icon' => 'whatsapp'],
    ['url' => $site->email()->isNotEmpty() ? 'mailto:' . $site->email() : '', 'name' => t('social.email'), 'icon' => 'email'],
];
?>
<ul class="social">
  <?php foreach ($links as $link): ?>
  <?php if ($link['url'] !== ''): ?>
  <li>
    <a class="social__link" href="<?= esc($link['url'], 'attr') ?>" aria-label="<?= esc($link['name'], 'attr') ?>">
      <img src="<?= url('assets/icons/social/' . $link['icon'] . '-white.svg') ?>" alt="" width="30" height="30">
    </a>
  </li>
  <?php endif ?>
  <?php endforeach ?>
</ul>
