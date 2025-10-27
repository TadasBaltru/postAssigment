<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Groups</title>
	<link rel="stylesheet" href="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/css/app.css" />
</head>
<body>
	<?php require __DIR__ . '/../partials/nav.php'; ?>
	<h1>Groups</h1>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($groups as $g): ?>
			<tr>
				<td><?= (int)$g['id'] ?></td>
				<td><?= htmlspecialchars($g['name'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<script src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/js/app.js"></script>
</body>
</html>


