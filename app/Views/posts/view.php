<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?= htmlspecialchars($post['title'] ?? 'Post', ENT_QUOTES, 'UTF-8') ?></title>
	<link rel="stylesheet" href="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/css/app.css" />
</head>
<body>
	<?php require __DIR__ . '/../partials/nav.php'; ?>
	<article class="card">
		<h1 class="card__title"><?= htmlspecialchars($post['title'] ?? '', ENT_QUOTES, 'UTF-8') ?></h1>
		<p class="card__meta">#<?= (int)$post['id'] ?> • <?= (int)$post['person_base_id'] ?> • <?= htmlspecialchars($post['post_date'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
		<div class="card__body">
			<p><?= nl2br(htmlspecialchars($post['content'] ?? '', ENT_QUOTES, 'UTF-8')) ?></p>
		</div>
	</article>
</body>
</html>


