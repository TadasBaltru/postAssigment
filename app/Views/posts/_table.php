<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Person Base ID</th>
			<th>Title</th>
			<th>Post Date</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($posts as $p): ?>
		<tr>
			<td><?= (int)$p['id'] ?></td>
			<td><?= (int)$p['person_base_id'] ?></td>
			<td><?= htmlspecialchars($p['title'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
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


