<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Posts</title>
	<link rel="stylesheet" href="/assets/css/app.css" />
</head>
<body>
	<?php require __DIR__ . '/../partials/nav.php'; ?>
  <h1>Manage Posts</h1>
  <p><a href="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/posts/create">Add new post</a></p>
	<table>
		<thead>
			<tr>
				<th>ID</th>
        <th>Person full name</th>
        <th>Group name</th>
        <th>Title</th>
				<th>Post Date</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($posts as $p): ?>
			<tr>
				<td><?= (int)$p['id'] ?></td>
          <td><?= htmlspecialchars($p['person_name'] ?? '', ENT_QUOTES, 'UTF-8') ?> <?= htmlspecialchars($p['person_surname'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
          <td><?= htmlspecialchars($p['title'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
          <td><?= htmlspecialchars($p['group_name'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
				<td><?= htmlspecialchars($p['post_date'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
				<td>
					<a class="btn btn--ghost" href="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/posts/<?= (int)$p['id'] ?>/edit">Edit</a>
					<form method="post" action="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/posts/<?= (int)$p['id'] ?>/delete" style="display:inline">
						<button class="btn btn--danger" type="submit" onclick="return confirm('Delete this post?')">Delete</button>
					</form>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<script src="<?= defined('BASE_PATH') ? BASE_PATH : '' ?>/assets/js/app.js"></script>
</body>
</html>


