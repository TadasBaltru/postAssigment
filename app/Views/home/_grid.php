<section class="grid" id="postsGrid">
<?php foreach ($posts as $p) : ?>
  <article class="card">
    <h2 class="card__title"><?= htmlspecialchars($p['title'] ?? '', ENT_QUOTES, 'UTF-8') ?></h2>
    <?php
      $snippet = trim((string)($p['content'] ?? ''));
      $words = preg_split('/\s+/', $snippet) ?: [];
    if (count($words) > 15) {
        $snippet = implode(' ', array_slice($words, 0, 15)) . '...';
    }
    ?>
    <p class="card__body"><?= htmlspecialchars($snippet, ENT_QUOTES, 'UTF-8') ?></p>
    <p class="card__meta">
      <?= htmlspecialchars(($p['person_name'] ?? '') . ' ' . ($p['person_surname'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
      <?php if (!empty($p['group_name'])) :
            ?> • <?= htmlspecialchars($p['group_name'], ENT_QUOTES, 'UTF-8') ?><?php
      endif; ?>
      • <?= htmlspecialchars($p['post_date'] ?? '', ENT_QUOTES, 'UTF-8') ?>
    </p>
    <div class="card__actions">
      <a class="btn" href="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/posts/<?= (int)$p['id'] ?>/view">View</a>
      <button class="btn btn--ghost open-edit" type="button" data-id="<?= (int)$p['id'] ?>" data-title="<?= htmlspecialchars($p['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-person="<?= (int)$p['person_base_id'] ?>" data-content="<?= htmlspecialchars($p['content'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-date="<?= htmlspecialchars($p['post_date'] ?? '', ENT_QUOTES, 'UTF-8') ?>">Edit</button>
      <button class="btn btn--danger delete-post" type="button" data-id="<?= (int)$p['id'] ?>">Delete</button>
    </div>
  </article>
<?php endforeach; ?>
</section>



