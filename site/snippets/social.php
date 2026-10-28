<?php
/*
  Icone social bianche (menu mobile e footer). Si vedono solo i link compilati
  nelle Impostazioni sito.
*/

// campo del pannello => indirizzo, nome per gli screen reader, icona e sua larghezza.
// Le icone hanno tutte la stessa altezza (30) ma larghezze diverse, prese dal viewBox di ogni SVG:
// così il CSS le mostra alla stessa altezza senza deformarle.
$links = [
    ['url' => $site->facebook()->value(), 'name' => t('social.facebook'), 'icon' => 'facebook', 'width' => 16],
    ['url' => $site->instagram()->value(), 'name' => t('social.instagram'), 'icon' => 'instagram', 'width' => 30],
    ['url' => $site->whatsapp()->value(), 'name' => t('social.whatsapp'), 'icon' => 'whatsapp', 'width' => 30],
    ['url' => $site->email()->isNotEmpty() ? 'mailto:' . $site->email() : '', 'name' => t('social.email'), 'icon' => 'email', 'width' => 38],
];
?>
<ul class="social">
  <?php foreach ($links as $link): ?>
  <?php if ($link['url'] !== ''): ?>
  <li>
    <a class="social__link" href="<?= esc($link['url'], 'attr') ?>" aria-label="<?= esc($link['name'], 'attr') ?>">
      <img src="<?= url('assets/icons/social/' . $link['icon'] . '-white.svg') ?>" alt="" width="<?= $link['width'] ?>" height="30">
    </a>
  </li>
  <?php endif ?>
  <?php endforeach ?>
</ul>
