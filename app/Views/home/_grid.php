<section class="grid" id="postsGrid">
<?php foreach ($posts as $p): ?>
  <article class="card">
    <h2 class="card__title"><?= htmlspecialchars($p['title'] ?? '', ENT_QUOTES, 'UTF-8') ?></h2>
    <?php
      $snippet = trim((string)($p['content'] ?? ''));
      $words = preg_split('/\s+/', $snippet) ?: [];
      if (count($words) > 15) { $snippet = implode(' ', array_slice($words, 0, 15)) . '...'; }
    ?>
    <p class="card__body"><?= htmlspecialchars($snippet, ENT_QUOTES, 'UTF-8') ?></p>
    <p class="card__meta">
      <?= htmlspecialchars(($p['person_name'] ?? '') . ' ' . ($p['person_surname'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
      <?php if (!empty($p['group_name'])): ?> • <?= htmlspecialchars($p['group_name'], ENT_QUOTES, 'UTF-8') ?><?php endif; ?>
      • <?= htmlspecialchars($p['post_date'] ?? '', ENT_QUOTES, 'UTF-8') ?>
    </p>
    <a class="btn" href="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/posts/<?= (int)$p['id'] ?>/view">Read more</a>
  </article>
<?php endforeach; ?>
</section>


