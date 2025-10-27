<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?= isset($post) ? 'Edit Post' : 'New Post' ?></title>
	<link rel="stylesheet" href="/assets/css/app.css" />
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script src="/assets/js/app.js"></script>
</head>
<body>
	<?php require __DIR__ . '/../partials/nav.php'; ?>
    <div class="form-card">
        <form class="form" method="post" id="postForm">
            <input type="hidden" name="id" value="<?= isset($post['id']) ? $post['id'] : '' ?>" />
            <div class="form__row">
                <div class="field">
                    <label class="field__label">Title</label>
                    <input class="field__input" type="text" name="title" required value="<?= isset($post['title']) ? htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') : '' ?>" />
                </div>
            </div>
            <div class="form__row form__row--two">
                <div class="field">
                    <label class="field__label">Person</label>
                    <select name="person_base_id" class="field__input" required>
                        <option value="">Select person...</option>
                        <?php foreach ($persons as $person): $val = $person['base_id']; ?>
                        <option value="<?= $val ?>" <?= isset($post['person_base_id']) && $post['person_base_id'] == $val ? 'selected' : '' ?>>
                            <?= htmlspecialchars($person['name'] . ' ' . $person['surname'], ENT_QUOTES, 'UTF-8') ?> (<?= $val ?>)
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
				<div class="field">
					<label class="field__label">Post date</label>
					<input class="field__input datetime-input" type="date" name="post_date" required value="<?= isset($post['post_date']) ? $post['post_date'] : '' ?>" />
				</div>

            </div>
            <div class="form__row">
                <div class="field">
                    <label class="field__label">Content</label>
                    <textarea class="field__input" name="content" rows="8" required><?= isset($post['content']) ? htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8') : '' ?></textarea>
                </div>
            </div>
            <div class="actions">
                <button class="btn btn--primary" type="submit" id="createBtn">Save</button>
                <a class="btn btn--ghost" href="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/posts">Cancel</a>
            </div>
        </form>
    </div>

</body>

</html>


