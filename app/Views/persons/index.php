<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Persons</title>
	<link rel="stylesheet" href="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/css/app.css" />
</head>
<body>
	<?php require __DIR__ . '/../partials/nav.php'; ?>
	<h1>Persons</h1>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Base ID</th>
				<th>Name</th>
				<th>Surname</th>
				<th>Group ID</th>
				<th>Valid From</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($persons as $p): ?>
			<tr>
				<td><?= (int)$p['id'] ?></td>
				<td><?= (int)$p['base_id'] ?></td>
				<td><?= htmlspecialchars($p['name'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
				<td><?= htmlspecialchars($p['surname'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
				<td><?= isset($p['group_id']) ? (int)$p['group_id'] : '' ?></td>
				<td><?= htmlspecialchars($p['valid_from'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<script src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/js/app.js"></script>
</body>
</html>



