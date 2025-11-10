<?php foreach ($posts as $p) : ?>
<tr>
    <td><?= htmlspecialchars($p['post_date'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
    <td><span class="group-badge"><?= htmlspecialchars($p['group_name'] ?? '', ENT_QUOTES, 'UTF-8') ?></span></td>
    <td><?= htmlspecialchars($p['content'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
    <td><?= htmlspecialchars(($p['person_name'] ?? '') . ' ' . ($p['person_surname'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
    <td class="text-end">
        <div class="action-buttons flex-row justify-content-end">
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
    </td>
</tr>
<?php endforeach; ?>