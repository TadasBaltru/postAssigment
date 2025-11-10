<?php foreach ($posts as $p) : ?>
<div class="mobile-post-card">
    <div class="mobile-post-header">
        <span class="mobile-post-group"><?= htmlspecialchars($p['group_name'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
        <span class="mobile-post-date"><?= htmlspecialchars($p['post_date'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
    </div>
    <div class="mobile-post-content">
        <?= htmlspecialchars($p['content'] ?? '', ENT_QUOTES, 'UTF-8') ?>
    </div>
    <div class="mobile-post-author">
        Author:<br> <?= htmlspecialchars(($p['person_name'] ?? '') . ' ' . ($p['person_surname'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
    </div>
    <div class="action-buttons mt-2 flex-row justify-content-end">
        <button
            class="btn-icon btn-edit open-edit"
            type="button"
            data-id="<?= (int)($p['id'] ?? 0) ?>"
            data-person="<?= (int)($p['person_base_id'] ?? 0) ?>"
            data-content="<?= htmlspecialchars($p['content'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
            data-date="<?= htmlspecialchars($p['post_date'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >
            <i><img src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/edit-button.svg" alt="Edit"></i>
        </button>
        <button class="btn-icon btn-delete delete-post" type="button" data-id="<?= (int)($p['id'] ?? 0) ?>">
            <i><img src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/icons/trash-01.svg" alt="Delete"></i>
        </button>
    </div>
</div>
<?php endforeach; ?>

